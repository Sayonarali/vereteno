<?php

namespace App\Admin\Controllers;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Product;
use App\Models\VendorCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class CartItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Корзины';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CartItem());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('user', __('Пользователь'))->display(function ($user) {
            $userId = $user['id'];
            $userName = $user['name'];
            return "<a href='/admin/user/$userId'>$userName</a>";
        });
        $grid->column('product.product_id', __('Название товара'))
            ->display(function ($productId) {
                return Product::find($productId)->name;
            });
        $grid->column('product.vendor_code_id', __('Артикул'))
            ->display(function ($codeId) {
                return VendorCode::find($codeId)->code;
            });
        $grid->column('product.price', __('Стоимость'))
            ->display(function ($price) {
                return $price . '₽';
            })->sortable();
        $grid->column('product.discount_id', __('Скидка'))
            ->display(function ($discountId) {
                return (100 - Discount::find($discountId)->discount_coefficient * 100) . '%';
            })->sortable();
        $grid->column('quantity', __('Количество'))->sortable();

        $grid->disableFilter();
        $grid->disableExport();

        $grid->disableCreateButton();
        $grid->setActionClass(Actions::class);
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->paginate(15);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(CartItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('product_vendor_code_id', __('Product vendor code id'));
        $show->field('quantity', __('Quantity'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CartItem());

        $form->number('user_id', __('User id'));
        $form->number('product_vendor_code_id', __('Product vendor code id'));
        $form->number('quantity', __('Quantity'));

        return $form;
    }
}

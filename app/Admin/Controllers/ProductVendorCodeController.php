<?php

namespace App\Admin\Controllers;

use App\Models\AttributeValue;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductVendorCode;
use App\Models\ProductVendorCodeSize;
use App\Models\Size;
use App\Models\VendorCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class ProductVendorCodeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Товары';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductVendorCode());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('product_id', __('Название продукта'))
            ->display(function ($productId) {
                return Product::find($productId)->name;
            })->sortable();
        $grid->column('vendor_code_id', __('Артикул'))
            ->display(function ($codeId) {
                return VendorCode::find($codeId)->code;
            })->sortable();
        $grid->column('discount.discount_coefficient', __('Множитель скидки'));
        $grid->column('price', __('Стоимость'))->display(function ($price) {
            return $price . '₽';
        });

        $grid->disableFilter();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->setActionClass(Actions::class);
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
        $show = new Show(ProductVendorCode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('vendor_code_id', __('Vendor code id'));
        $show->field('discount_id', __('Discount id'));
        $show->field('price', __('Price'));
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
        $form = new Form(new ProductVendorCode());

        $form->select('product_id', __('Название продукта'))->options(Product::all()->pluck('name', 'id'))->setWidth(4)->required();
        $form->select('vendor_code_id', __('Артикул'))->setWidth(4)->required()
            ->options(VendorCode::all()->pluck('code', 'id'))->setWidth(4);
        $form->select('discount_id', __('Множитель скидки'))
            ->options(Discount::all()->pluck('discount_coefficient', 'id'))->setWidth(4);
        $form->decimal('price', __('Стоимость'));

        $form->multipleSelect('attributes', 'Особенности')
            ->options(AttributeValue::all()->pluck('value', 'id'))->setWidth(4);
        $form->checkbox('sizes', 'Размеры')
            ->options(Size::all()->pluck('number', 'id'))->setWidth(4);

        if ($form->isEditing()) {
            $form->hasMany('images', __('Картинки'), function (Form\NestedForm $form) {
                $form->image('path', 'Изображение')
                    ->move('/images/product')
                    ->removable()
                    ->downloadable()
                    ->uniqueName();
            })->setWidth(4);
        }

        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}

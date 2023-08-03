<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\ProductVendorCode;
use App\Models\ProductVendorCodeImage;
use App\Models\VendorCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class ProductVendorCodeImagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Фотографии';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductVendorCodeImage());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('product_vendor_code_id', __('Название продукта'))
            ->display(function ($codeId) {
                return ProductVendorCode::find($codeId)->product->name;
            })->sortable();
        $grid->column('path', __('Изображение'))->image('', 100, 100);

        $grid->column('code.vendor_code_id', __('Артикул'))
            ->display(function ($codeId) {
                return VendorCode::find($codeId)->code;
            })->sortable();


        $grid->column('size', __('Размер изображения'))
            ->display(function ($size) {
                return $size . ' МБ';
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
        $show = new Show(ProductVendorCodeImage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('disk', __('Disk'));
        $show->field('path', __('Path'));
        $show->field('title', __('Title'));
        $show->field('product_vendor_code_id', __('Product vendor code id'));
        $show->field('size', __('Size'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductVendorCodeImage());

        $form->display('disk', __('Диск'))->default('images')->setWidth(2);
        $form->image('path', __('Картинка'))
            ->name(function ($file) {
                return '/product/' . $file->guessExtension();
            });
        $form->text('title', __('Название'));
        $form->select('product_vendor_code_id', __('Название продукта'))
            ->options(Product::all()->pluck('name', 'id'))->setWidth(4)->required();
        $form->number('size', __('Размер изображения'))->setWidth(2)->default(12345);

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

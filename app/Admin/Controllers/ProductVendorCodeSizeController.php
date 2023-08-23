<?php

namespace App\Admin\Controllers;

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

class ProductVendorCodeSizeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'В наличии';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductVendorCodeSize());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('product_vendor_code_id', __('Название товара'))
            ->display(function ($codeId) {
                return ProductVendorCode::find($codeId) ? ProductVendorCode::find($codeId)->product->name : '';
            })->sortable();

        $grid->column('code.vendor_code_id', __('Артикул'))
            ->display(function ($codeId) {
                return VendorCode::find($codeId) ? VendorCode::find($codeId)->code : '';
            })->sortable();

        $grid->column('size.number', __('Размер'))->sortable();
        $grid->column('quantity', __('Количество'))
            ->display(function ($quantity) {
                return $quantity . ' шт.';
            })->sortable();


        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->setActionClass(Actions::class);
        $grid->paginate(20);

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
        $show = new Show(ProductVendorCodeSize::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_vendor_code_id', __('Product vendor code id'));
        $show->field('size_id', __('Size id'));
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
        $form = new Form(new ProductVendorCodeSize());

        $form->select('product_vendor_code_id', __('Название товара'))
            ->options(Product::all()->pluck('name', 'id'))->setWidth(4)->required();
        $form->select('code.vendor_code_id', __('Артикул'))
            ->options(VendorCode::all()->pluck('code', 'id'))->setWidth(4)->required();
        $form->display('size.number', __('Размер'))->setWidth(1);
        $form->number('quantity', __('В наличии'));

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

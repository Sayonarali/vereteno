<?php

namespace App\Admin\Controllers;

use App\Models\OrderItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OrderItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderItem());

        $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('product_vendor_code_id', __('Product vendor code id'));
        $grid->column('price', __('Price'));
        $grid->column('amount', __('Amount'));
        $grid->column('quantity', __('Quantity'));

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
        $show = new Show(OrderItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order id'));
        $show->field('product_vendor_code_id', __('Product vendor code id'));
        $show->field('price', __('Price'));
        $show->field('amount', __('Amount'));
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
        $form = new Form(new OrderItem());

        $form->number('order_id', __('Order id'));
        $form->number('product_vendor_code_id', __('Product vendor code id'));
        $form->decimal('price', __('Price'));
        $form->decimal('amount', __('Amount'));
        $form->number('quantity', __('Quantity'));

        return $form;
    }
}

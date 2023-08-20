<?php

namespace App\Admin\Controllers;

use App\Models\OrderAddress;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderAddressController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OrderAddress';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderAddress());

        $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('country', __('Country'));
        $grid->column('region', __('Region'));
        $grid->column('city', __('City'));
        $grid->column('street', __('Street'));
        $grid->column('postcode', __('Postcode'));

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
        $show = new Show(OrderAddress::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order id'));
        $show->field('country', __('Country'));
        $show->field('region', __('Region'));
        $show->field('city', __('City'));
        $show->field('street', __('Street'));
        $show->field('postcode', __('Postcode'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrderAddress());

        $form->number('order_id', __('Order id'));
        $form->text('country', __('Country'));
        $form->text('region', __('Region'));
        $form->text('city', __('City'));
        $form->text('street', __('Street'));
        $form->text('postcode', __('Postcode'));

        return $form;
    }
}

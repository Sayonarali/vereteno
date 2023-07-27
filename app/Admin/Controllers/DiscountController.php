<?php

namespace App\Admin\Controllers;

use App\Models\Discount;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DiscountController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Discount';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Discount());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('discount_coefficient', __('Discount coefficient'));

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
        $show = new Show(Discount::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('discount_coefficient', __('Discount coefficient'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Discount());

        $form->text('name', __('Name'));
        $form->decimal('discount_coefficient', __('Discount coefficient'));

        return $form;
    }
}
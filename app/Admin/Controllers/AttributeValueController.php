<?php

namespace App\Admin\Controllers;

use App\Models\AttributeValue;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AttributeValueController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AttributeValue';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AttributeValue());

        $grid->column('id', __('ID'));
        $grid->column('attribute_id', __('Attribute id'));
        $grid->column('value', __('Value'));

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
        $show = new Show(AttributeValue::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('attribute_id', __('Attribute id'));
        $show->field('value', __('Value'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AttributeValue());

        $form->number('attribute_id', __('Attribute id'));
        $form->text('value', __('Value'));

        return $form;
    }
}

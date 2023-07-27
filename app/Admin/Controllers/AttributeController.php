<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Attribute\AddValues;
use App\Models\Attribute;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class AttributeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Особенности';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Attribute());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Особенность'))->sortable();
        $grid->column('values', __('Значения'))->display(function ($values) {
            $values = array_map(function ($value) {
                return "<span class='label label-default' style='font-size: 15px'>{$value['value']}</span>";
            }, $values);
            return join('&nbsp;', $values);
        })->sortable();

        $grid->disableFilter();

        $grid->quickSearch(function ($model, $query) {
            $model->where('name', 'like', "%{$query}%");
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->setActionClass(Actions::class);
        $grid->paginate(10);

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
        $show = new Show(Attribute::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Attribute());

        $form->text('name', __('Особенность'))->setWidth(3)->required()->autofocus();

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}

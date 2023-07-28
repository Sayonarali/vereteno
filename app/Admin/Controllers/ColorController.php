<?php

namespace App\Admin\Controllers;

use App\Models\Color;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class ColorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Цвета';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Color());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Название'));
        $grid->column('hex', __('Hex'))->display(function ($color) {
            return "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='$color' class='bi bi-circle-fill' viewBox='0 0 16 16'><circle cx='8' cy='8' r='8'/></svg>";
        });

        $grid->export(function ($export) {
            $export->except(['hex']);
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->disableFilter();

        $grid->quickSearch(function ($model, $query) {
            $model->where('name', 'like', "%{$query}%");
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
        $show = new Show(Color::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('hex', __('Hex'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Color());

        $form->text('name', __('Название'))->required()->autofocus()->setWidth(3);
        $form->color('hex', __('Hex'))->required()->setWidth(4);

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

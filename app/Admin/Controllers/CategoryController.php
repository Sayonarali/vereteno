<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Категории';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('ID'));
        $grid->column('name', __('Название'))->sortable();
        $grid->column('slug', __('Слаг'));
        $grid->column('description', __('Описание'));
        $grid->column('level', __('Уровень'))->sortable();
        $grid->column('parent.name', __('Родительская категория'))->sortable();

        $grid->disableFilter();

        $grid->quickSearch(function ($model, $query) {
            $model->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('slug', 'like', "%{$query}%");
        });
        $grid->setActionClass(Actions::class);

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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
        $show->field('level', __('Level'));
        $show->field('parent_id', __('Parent id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('name', __('Название'))->setWidth(3)->required()->autofocus();
        $form->textarea('description', __('Описание'))->setWidth(4)->rows(9)->required();
        $form->text('slug', __('Слаг'))->setWidth(3)->required();
        $form->number('level', __('Уровень'))->default(1);
        $form->select('parent', 'Родительская категория')->options(Category::all()->pluck('name', 'id'))->setWidth(2);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}

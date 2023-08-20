<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\VendorCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Продукты';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Название'))->sortable();
        $grid->column('description', __('Описание'))->width(500);
        $grid->column('slug', __('Слаг'));
        $grid->column('category.name', __('Категория'))->sortable();
        $grid->column('codes', __('Артикулы'))->display(function ($codes) {
            $codes = array_map(function ($code) {
                return "<span class='label label-default' style='font-size: 13px'>{$code['code']}</span>";
            }, $codes);
            return join('&nbsp;', $codes);
        });

        $grid->disableFilter();

        $grid->quickSearch(function ($model, $query) {
            $model->whereHas('category', function ($builder) use ($query) {
                return $builder->where('name', 'like', "%{$query}%");
            })
                ->where('products.name', 'like', "%{$query}%")
                ->orWhere('products.description', 'like', "%{$query}%")
                ->orWhere('products.slug', 'like', "%{$query}%");
        });

        $grid->setActionClass(Actions::class);
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Название'));
        $show->field('description', __('Описание'));
        $show->field('slug', __('Слаг'));
        $show->field('category.name', __('Категория'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('name', __('Название'))->setWidth(3)->required()->autofocus();
        $form->textarea('description', __('Описание'))->setWidth(4)->rows(9)->required();
        $form->text('slug', __('Слаг'))->setWidth(3)->required();
        $form->select('category_id', __('Категория'))->options(Category::all()->pluck('name', 'id'))->setWidth(3);

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

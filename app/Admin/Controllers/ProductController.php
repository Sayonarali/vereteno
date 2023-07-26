<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Товары';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Название'))->sortable()->filter();
        $grid->column('description', __('Описание'))->width(500);
        $grid->column('slug', __('Слаг'));
        $grid->column('category.name', __('Категория'))->sortable();
        $grid->column('codes', __('Артикулы'))->display(function ($codes) {
            $codes = array_map(function ($code) {
                return "<span class='label label-default'>{$code['code']}</span>";
            }, $codes);
            return join('&nbsp;', $codes);
        });

        $grid->filter(function($filter){
//            $filter->scope('new', 'Recently modified')->where('name', 'b');
            $filter->equal('name', __('Название'));
            $filter->equal('description', __('Описание'));
            $filter->equal('category.name', __('Категория'))->select('api/v1/category');
            $filter->in('codes', __('Артикулы'))->select('api/v1/product/list/codes');

            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'yes':
                        // custom complex query if the 'yes' option is selected
                        $query->has('codes');
                        break;
                    case 'no':
                        $query->doesntHave('codes');
                        break;
                }
            }, 'Label of the field', 'name_for_url_shortcut')->radio([
                '' => 'Все',
                'yes' => 'С артикулами',
                'no' => 'Без артикулов',
            ]);


        });

        $grid->actions(function ($actions) {

            // append an action.
            $actions->append('<a href=""><i class="fa fa-eye"></i></a>');

            // prepend an action.
            $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');
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

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->text('slug', __('Slug'));
        $form->number('category_id', __('Category id'));

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\Statpage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Баннер';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Statpage());

        $grid->model()->where('alias', 'banner');

        $grid->column('id', __('ID'))->sortable();
        $grid->column('title', __('Заголовок'));
        $grid->column('content', __('Содержание'))->width(450);
        $grid->column('path', __('Картинка'))->image('', 300);
        $grid->column('meta_description', __('Надпись на кнопке'));
        $grid->column('meta_keywords', __('Ссылка'));

        $grid->disableFilter();
        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $show = new Show(Statpage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('alias', __('Alias'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('path', __('Path'));
        $show->field('meta_description', __('Meta description'));
        $show->field('meta_keywords', __('Meta keywords'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Statpage());

        $form->text('alias', __('Элиас'))->setWidth(3)->default('banner')->readonly();
        $form->text('title', __('Заголовок'))->setWidth(3)->required();
        $form->textarea('content', __('Содержание'))->setWidth(5);
        $form->image('path', __('Картинка'))->setWidth(4)->required();
        $form->text('meta_description', __('Надпись на кнопке'))->setWidth(6);
        $form->text('meta_keywords', __('Ссылка'))->setWidth(6);


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

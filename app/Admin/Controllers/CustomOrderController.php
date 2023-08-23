<?php

namespace App\Admin\Controllers;

use App\Models\CustomOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class CustomOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пошив на заказ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CustomOrder());

        $grid->column('id', __('ID'));
        $grid->column('phone', __('Телефон'));
        $grid->column('name', __('Имя'));
        $grid->column('description', __('Содержание'));
        $grid->column('status', __('Статус'))
            ->label([
                'new' => 'success',
                'process' => 'info',
                'approved' => 'default',
            ])->sortable();;
        $grid->column('created_at', __('Отправлено'));
        $grid->column('updated_at', __('Обновлено'));

        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableCreateButton();

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
        $show = new Show(CustomOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('phone', __('Phone'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CustomOrder());

        $form->display('phone', __('Телефон'))->setWidth(2);
        $form->display('name', __('Имя'))->setWidth(2);
        $form->display('description', __('Содержание'))->setWidth(4);
        $form->select('status', __('Status'))->default('new')
            ->options(['new' => 'новый', 'process' => 'в процессе', 'approved' => 'обработан'])
            ->setWidth(2);

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

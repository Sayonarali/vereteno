<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Пользователи';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('ID'));
        $grid->column('login', __('Ник'));
        $grid->column('name', __('Имя'));
        $grid->column('surname', __('Фамилия'));
        $grid->column('patronymic', __('Отчество'));
        $grid->column('email', __('Почта'));
        $grid->column('phone', __('Номер телефона'));

        $grid->disableFilter();

        $grid->quickSearch(function ($model, $query) {
            $model->where('name', 'like', "%{$query}%")
                ->orWhere('login', 'like', "%{$query}%")
                ->orWhere('surname', 'like', "%{$query}%")
                ->orWhere('patronymic', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%");
        });

        $grid->disableCreateButton();
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('login', __('Login'));
        $show->field('name', __('Name'));
        $show->field('surname', __('Surname'));
        $show->field('patronymic', __('Patronymic'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('profile_image', __('Profile image'));
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
        $form = new Form(new User());

        $form->text('login', __('Login'));
        $form->text('name', __('Name'));
        $form->text('surname', __('Surname'));
        $form->text('patronymic', __('Patronymic'));
        $form->email('email', __('Email'));
        $form->mobile('phone', __('Phone'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->text('profile_image', __('Profile image'));

        return $form;
    }
}

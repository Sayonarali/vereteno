<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('login', __('Login'));
        $grid->column('name', __('Name'));
        $grid->column('surname', __('Surname'));
        $grid->column('patronymic', __('Patronymic'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('profile_image', __('Profile image'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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

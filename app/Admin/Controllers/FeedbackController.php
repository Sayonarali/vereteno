<?php

namespace App\Admin\Controllers;

use App\Models\ProductVendorCode;
use App\Models\ProductVendorCodeFeedback;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class FeedbackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Отзывы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductVendorCodeFeedback());

        $grid->column('id', __('ID'));
        $grid->column('comment', __('Комментарий'));
        $grid->column('user', __('Пользователь'))->display(function ($user) {
            return $user['login'];
        });
        $grid->column('product_vendor_code_id', __('Название продукта'))
            ->display(function ($codeId) {
                return ProductVendorCode::find($codeId) ? ProductVendorCode::find($codeId)->product->name : '';
            })->sortable();
        $grid->column('rating', __('Оценка'));

        $grid->disableFilter();
        $grid->disableExport();

        $grid->disableCreateButton();
        $grid->setActionClass(Actions::class);

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
        });
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
        $show = new Show(ProductVendorCodeFeedback::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('comment', __('Comment'));
        $show->field('user_id', __('User id'));
        $show->field('product_vendor_code_id', __('Product vendor code id'));
        $show->field('rating', __('Rating'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductVendorCodeFeedback());

        $form->text('comment', __('Comment'));
        $form->number('user_id', __('User id'));
        $form->number('product_vendor_code_id', __('Product vendor code id'));
        $form->number('rating', __('Rating'));

        return $form;
    }
}

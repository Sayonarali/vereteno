<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Заказы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('ID'));
        $grid->column('user', __('Заказчик'))->display(function ($user) {
            $userId = $user['id'];
            $userName = $user['name'];
            return "<a href='/admin/user/$userId'>$userName</a>";
        });
        $grid->column('status', __('Статус'))
            ->label([
                'new' => 'success',
                'process' => 'info',
                'delivered' => 'default',
                'cancel' => 'warning',
            ]);
        $grid->column('total', __('Общая сумма заказа'))->display(function ($sum) {
            return $sum . ' ₽';
        });
        $grid->column('payment_status', __('Статус оплаты'))->bool(['paid' => true, 'unpaid' => false]);
        $grid->column('payment_method', __('Способ оплаты'))->display(function ($method) {
            if ($method === 'online') {
                return "<span class='badge bg-olive-active'>online</span></h1>";
            }
            return "<span class='badge hover-bg-moon-gray'>offline</span></h1>";
        });
        $grid->column('created_at', __('Создан'));
        $grid->column('updated_at', __('Обновлен'));

        $grid->disableFilter();

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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('status', __('Status'));
        $show->field('total', __('Total'));
        $show->field('payment_status', __('Payment status'));
        $show->field('payment_method', __('Payment method'));
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
        $form = new Form(new Order());

        $form->select('user_id', __('Заказчик'))->options(User::all()->pluck('login', 'id'))->setWidth(4)->required();
        $form->select('status', __('Статус'))
            ->options(['new' => 'новый', 'process' => 'в процессе', 'delivered' => 'доставлен', 'cancel' => 'отменен'])
            ->setWidth(2)->required();
        $form->decimal('total', __('Общая сумма'))->required();
        $form->select('payment_status', __('Статус оплаты'))->options(['unpaid' => 'не оплачен', 'paid' => 'оплачен'])->setWidth(2)->required();
        $form->select('payment_method', __('Способ оплаты'))->options(['online' => 'онлайн', 'offline' => 'в магазине'])->setWidth(2)->required();

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\Color;
use App\Models\Material;
use App\Models\VendorCode;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Show;

class VendorCodeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Артикулы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VendorCode());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('code', __('Артикул'))->sortable();
        $grid->column('material.name', __('Материал'))->sortable();
        $grid->column('color.name', __('Цвет'))->sortable();
        $grid->column('color.hex', __('Hex'))->display(function ($color) {
            return "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='$color' class='bi bi-circle-fill' viewBox='0 0 16 16'><circle cx='8' cy='8' r='8'/></svg>";
        });

        $grid->export(function ($export) {
            $export->except(['color.hex']);
        });
        $grid->disableFilter();

        $grid->quickSearch(function ($model, $query) {
            $model->whereHas('color', function ($builder) use ($query) {
                return $builder->orWhere('name', 'like', "%{$query}%");
            })
                ->whereHas('material', function ($builder) use ($query) {
                    return $builder->orWhere('name', 'like', "%{$query}%");
                });
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $show = new Show(VendorCode::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('code', __('Артикул'));
        $show->field('material_id', __('Материал'));
        $show->field('color_id', __('Цвет'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VendorCode());

        $form->text('code', __('Артикул'))->setWidth(3)->required()->autofocus();
        $form->select('material_id', __('Материал'))->options(Material::all()->pluck('name', 'id'))->setWidth(4);
        $form->select('color_id', __('Цвет'))->options(Color::all()->pluck('name', 'id'))->setWidth(4);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}

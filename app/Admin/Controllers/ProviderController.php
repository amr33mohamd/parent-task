<?php

namespace App\Admin\Controllers;

use App\Models\Provider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProviderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Provider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Provider());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('balance', __('Balance'));
        $grid->column('status', __('Status'));
        $grid->column('currency', __('Currency'));
        $grid->column('identification', __('Identification'));
        $grid->column('authorised', __('Authorised'));
        $grid->column('declined', __('Declined'));
        $grid->column('created_at', __('Created at'));
        $grid->column('created_at_format', __('Created at format'));

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
        $show = new Show(Provider::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('balance', __('Balance'));
        $show->field('status', __('Status'));
        $show->field('currency', __('Currency'));
        $show->field('identification', __('Identification'));
        $show->field('authorised', __('Authorised'));
        $show->field('declined', __('Declined'));
        $show->field('created_at', __('Created at'));
        $show->field('created_at_format', __('Created at format'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Provider());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->text('balance', __('Balance'));
        $form->text('status', __('Status'));
        $form->text('currency', __('Currency'));
        $form->text('identification', __('Identification'));
        $form->text('authorised', __('Authorised'));
        $form->text('declined', __('Declined'));
        $form->text('created_at_format', __('Created at format'));

        return $form;
    }
}

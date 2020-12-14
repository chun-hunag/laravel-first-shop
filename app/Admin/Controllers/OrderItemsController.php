<?php

namespace App\Admin\Controllers;

use App\OrderItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderItemsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OrderItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderItem());

        $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('product_sku_id', __('Product sku id'));
        $grid->column('amount', __('Amount'));
        $grid->column('review', __('Review'));
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
        $show = new Show(OrderItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order id'));
        $show->field('product_id', __('Product id'));
        $show->field('product_sku_id', __('Product sku id'));
        $show->field('amount', __('Amount'));
        $show->field('review', __('Review'));
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
        $form = new Form(new OrderItem());

        $form->number('order_id', __('Order id'));
        $form->number('product_id', __('Product id'));
        $form->number('product_sku_id', __('Product sku id'));
        $form->number('amount', __('Amount'));
        $form->textarea('review', __('Review'));

        return $form;
    }
}

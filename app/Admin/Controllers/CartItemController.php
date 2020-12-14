<?php

namespace App\Admin\Controllers;

use App\CartItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CartItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CartItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CartItem());

        $grid->column('id', __('Id'));
        $grid->column('cart_id', __('Cart id'));
        $grid->column('product_sku_id', __('Product sku id'));
        $grid->column('amount', __('Amount'));
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
        $show = new Show(CartItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('cart_id', __('Cart id'));
        $show->field('product_sku_id', __('Product sku id'));
        $show->field('amount', __('Amount'));
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
        $form = new Form(new CartItem());

        $form->number('cart_id', __('Cart id'));
        $form->number('product_sku_id', __('Product sku id'));
        $form->number('amount', __('Amount'));

        return $form;
    }
}

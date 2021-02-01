<?php

namespace App\Admin\Controllers;

use App\ProductSku;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductSkuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductSku';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductSku());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('stock_number', __('Stock number'));
        $grid->column('stock', __('Stock'));
        $grid->column('product_id', __('Product id'));
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
        $show = new Show(ProductSku::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('stock_number', __('Stock number'));
        $show->field('stock', __('Stock'));
        $show->field('product_id', __('Product id'));
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
        $form = new Form(new ProductSku());

        $form->text('title', __('Title'));
        $form->text('description', __('Description'));
        $form->text('stock_number', __('Stock number'));
        $form->number('stock', __('Stock'));
        $form->number('product_id', __('Product id'));

        return $form;
    }
}

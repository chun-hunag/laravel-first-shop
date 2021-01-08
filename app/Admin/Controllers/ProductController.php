<?php

namespace App\Admin\Controllers;

use App\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;


class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('cover_image', __('Cover Image'));
        $grid->column('images', __('Images'));
        $grid->column('sold_count', __('Sold count'));
        $grid->column('review_count', __('Review count'));
        $grid->column('price', __('Price'));
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('on_sale', __('On Sale'));
        $show->field('cover_image', __('Cover Image'))->as(function ($image) {
            return "<img src='/upload/" . $image . "' style=\"max-width:200px; max-height:200px\"/>";
        })->unescape();
        $show->images('images')->as(function ($images) {
            $html = '';
            // $images = json_decode($images);
            foreach ($images as $key => $image)
            {
                $html .= "<img src='/upload" . $image . "' style=\"max-width:200px; max-height:200px\"/>";
                $html .= '&nbsp;&nbsp;';
            }
            return $html;
        })->unescape();
        // $show->field('images', __('Images'));
        $show->field('sold_count', __('Sold count'));
        $show->field('review_count', __('Review count'));
        $show->field('price', __('Price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->productSkus('ProductSkus', function ($productSkus) {

            $productSkus->resource('/admin/productSkus');
        
            $productSkus->id();
            $productSkus->title();
            $productSkus->description();
            $productSkus->stock_number();
            $productSkus->price();
            $productSkus->stock();
            $productSkus->created_at();
            $productSkus->updated_at();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('title', __('Title'));
        $form->editor('description', __('Description'))->rules('required');
        $form->radio('on_sale', 'On Sale')->options([true => 'Yes', false=> 'No'])->default(false);
        $form->number('price', __('Price'))->default(0)->readonly();;
        $form->number('sold_count', __('Sold count'));
        $form->number('review_count', __('Review count'));
        // $form->decimal('price', __('Price'));
        $form->image('cover_image', __('Cover Imgaes'))->rules('required|image')
             ->name(function ($file) {
                return'cover_image.'.$file->guessExtension();
             })->move('/images/products/tmp')->removable();

        $form->multipleImage('images', __('Images'))->rules('image')
                ->uniqueName()->move('/images/products/tmp')->removable();

        $form->hasMany('productSkus', __('Product Sku List'), function (Form\NestedForm $form) {
            $form->text('title', __('SKU Title'))->rules('required');
            $form->text('description', __('SKU Description'))->rules('required');
            $form->text('stock_number', __('Stock Number')); 
            $form->decimal('price', __('Price'))->rules('required|numeric|min:0.01');
            $form->number('stock', __('Stock'))->rules('required|integer|min:0');
        });

        $form->saving(function (Form $form) {
            $form->price = collect($form->input('productSkus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('price') ?: 0;
        });
        return $form;
    }

     /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {   
        // return $this->form();
        // return view('layouts.admin.form_upload');

        // return view('admin.products.create');

        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    
    // /**
    //  * Edit interface.
    //  *
    //  * @param mixed   $id
    //  * @param Content $content
    //  *
    //  * @return Content
    //  */
    // public function edit($id, Content $content)
    // {
    //     // $form = $this->form()->edit($id);
    //     // $data = $form->model()->getAttributes();
    //     // $form->fields()[5]->setValue($data['cover_image']);
    //     // dump($form->fields());exit;
    //     // dump($this->form()->edit($id)->fields());exit;

    //     return $content
    //         ->title($this->title())
    //         ->description($this->description['edit'] ?? trans('admin.edit'))
    //         ->body($this->form()->edit($id));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {   
        return $this->form()->store();
    }

}

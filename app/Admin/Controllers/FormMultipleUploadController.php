<?php

namespace App\Admin\Controllers;

use App\FormMultipleUpload;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormMultipleUploadController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormMultipleUpload';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormMultipleUpload());



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
        $show = new Show(FormMultipleUpload::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FormMultipleUpload());



        return $form;
    }

    /**
     * Store image
     * 
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'filename' => 'required',
            'product_id' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/image', $name); // file path
                $data[] = $name;
            }
        }
        $upload_model = new FormMultipleUpload;
        $upload_model->filename = json_decode($date);
        $upload_model->save();
        return back()->with('success', 'Your images has been uploaded successfully');
    }
}

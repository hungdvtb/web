<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Chapter;

class ChapterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Chapter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Chapter());

        $grid->column('id', __('Id'));
        $grid->column('book_id', __('Book id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('description', __('Description'))->display(function($smr){
            return mb_substr($smr,0,100);
        });;
        $grid->column('content', __('Content'))->display(function($smr){
            return mb_substr($smr,0,100);
        });;
        $grid->column('active', __('Active'));
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
        $show = new Show(Chapter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('book_id', __('Book id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('active', __('Active'));
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
        $form = new Form(new Chapter());

        $form->number('book_id', __('Book id'));
        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->text('description', __('Description'));
        $form->ckeditor('content', __('Content'));
        $form->number('active', __('Active'));

        return $form;
    }
}

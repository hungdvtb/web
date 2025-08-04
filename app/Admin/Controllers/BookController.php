<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
class BookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Book';


    public function createbook(Request $request)
    {
        $slug = Str::slug($request->slug ?? $request->name);
         
        if (Book::where('slug', $slug)->exists()) {
            return response()->json([
                'message' => 'Truyện đã tồn tại với slug này.',
                'slug' => $slug
            ], 409); // 409 Conflict
        }
        DB::beginTransaction();
        try {
            $book = Book::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug ?? $request->name),
                'summary' => $request->summary,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'thumb' => $request->thumb,
                'author' => $request->author,
                'hot_book' => $request->hot_book ?? 0,
                'views' => $request->views ?? 0,
                'active' => $request->active ?? 1,
                'start_url' => $request->start_url,
                'source_type' => $request->source_type,
                'origin_url' => $request->origin_url,
            ]);

            foreach ($request->chapper ?? [] as $chapter) {
                Chapter::create([
                    'book_id' => $book->id,
                    'name' => $chapter['name'],
                    'slug' => Str::slug($chapter['slug'] ?? $chapter['name']),
                    'description' => $chapter['description'] ?? '',
                    'content' => $chapter['content'],
                    'active' => $chapter['active'] ?? 1,
                ]);
            }

            DB::commit();

            return response()->json(['id' => $book->id], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Book());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('summary', __('Summary'))->display(function($smr){
            return mb_substr($smr,0,40);
        });
        $grid->column('description', __('Description'))->display(function($smr){
            return mb_substr($smr,0,100);
        });
        $grid->column('category_id', __('Category id'));
        $grid->column('thumb', __('Thumb'));
        $grid->column('author', __('Author'));
        $grid->column('hot_book', __('Hot book'));
        $grid->column('views', __('Views'));
        $grid->column('active', __('Active'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('start_url', __('Start url'));
        $grid->column('source_type', __('Source type'));
        $grid->column('origin_url', __('Origin url'));

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
        $show = new Show(Book::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('summary', __('Summary'));
        $show->field('description', __('Description'));
        $show->field('category_id', __('Category id'));
        $show->field('thumb', __('Thumb'));
        $show->field('author', __('Author'));
        $show->field('hot_book', __('Hot book'));
        $show->field('views', __('Views'));
        $show->field('active', __('Active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('start_url', __('Start url'));
        $show->field('source_type', __('Source type'));
        $show->field('origin_url', __('Origin url'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Book());

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->textarea('summary', __('Summary'));
        $form->textarea('description', __('Description'));
        $form->number('category_id', __('Category id'));
        $form->text('thumb', __('Thumb'));
        $form->text('author', __('Author'));
        $form->number('hot_book', __('Hot book'));
        $form->number('views', __('Views'));
        $form->number('active', __('Active'));
        $form->text('start_url', __('Start url'));
        $form->text('source_type', __('Source type'));
        $form->text('origin_url', __('Origin url'));

        return $form;
    }
}

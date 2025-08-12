<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Book';


    public function getcontent(Request $request)
    {
        $response = Http::get($request->input('url'));
        $html = $response->body();
        return response()->json([
            'content' => $html
        ], $response->status());
    }

    public function uploadImageFromUrlToS3($imageUrl)
    {
        try {
            // Lấy nội dung ảnh từ URL
            $response = Http::timeout(10)->get($imageUrl);

            if (!$response->successful()) {
                throw new \Exception('Không lấy được ảnh từ URL');
            }

            $imageContent = $response->body();

            // Tạo tên file ngẫu nhiên
            $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
            $fileName = 'uploads/' . Str::random(40) . '.' . $extension;

            // Upload lên S3
            Storage::disk('s3')->put($fileName, $imageContent, 'public');

            // Trả về URL công khai
            return Storage::disk('s3')->url($fileName);
        } catch (\Exception $e) {
            return '';
        }
    }

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
        $categories  = $request->categories ?? [];
        $cateIds = [];
        foreach($categories as $category) {
            $cate =  Category::firstOrCreate([
                'name' => $category,
                'slug' => $this->vnSlug($category),
                'active' => 1
            ], [
                
            ]);
            $cateIds[] = $cate->id;
        }
        try {
            $image = $this->uploadImageFromUrlToS3($request->thumb); 
            $chapters = $request->chapper ?? [];
            $book = Book::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug ?? $request->name),
                'summary' => $request->summary,
                'description' => $request->description,
                'category_id' => $cateIds ? $cateIds[0] : 0,
                'thumb' => $image, 
                'rating_count' => $request->rate_count ?? 0,
                'average_rating' => $request->rate ?? 0,
                'author' => $request->author,
                'hot_book' => $request->hot_book ?? 0,
                'views' => $request->views ?? 0,
                'active' => $request->active ?? 1,
                'start_url' => $request->start_url,
                'source_type' => $request->source_type,
                'origin_url' => $request->orgin_url,
                'last_updated'=> $chapters[count($chapters) - 1]['updated_at'] ? date('Y-m-d H:i:s', strtotime($chapters[count($chapters) - 1]['updated_at'])) : date('Y-m-d H:i:s')
            ]);
             $book->book_in_multiple_cate()->attach($cateIds);

            foreach ($request->chapper ?? [] as $chapter) {
                Chapter::create([
                    'book_id' => $book->id,
                    'name' => $chapter['name'],
                    'slug' => $chapter['slug'] ?? $this->vnSlug($chapter['name']),
                    'description' => $chapter['description'] ?? '',
                    'content' => $chapter['content'],
                    'active' => $chapter['active'] ?? 1,
                    'updated_at' => $chapter['updated_at'] ?? now(),
                    'created_at' => $chapter['updated_at'] ?? now(),
                ]);
            }

            DB::commit();

            return response()->json(['id' => $book->id], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }
    function vnSlug($string) {
        $map = [
            'à'=>'a','á'=>'a','ạ'=>'a','ả'=>'a','ã'=>'a',
            'â'=>'a','ầ'=>'a','ấ'=>'a','ậ'=>'a','ẩ'=>'a','ẫ'=>'a',
            'ă'=>'a','ằ'=>'a','ắ'=>'a','ặ'=>'a','ẳ'=>'a','ẵ'=>'a',
            'è'=>'e','é'=>'e','ẹ'=>'e','ẻ'=>'e','ẽ'=>'e',
            'ê'=>'e','ề'=>'e','ế'=>'e','ệ'=>'e','ể'=>'e','ễ'=>'e',
            'ì'=>'i','í'=>'i','ị'=>'i','ỉ'=>'i','ĩ'=>'i',
            'ò'=>'o','ó'=>'o','ọ'=>'o','ỏ'=>'o','õ'=>'o',
            'ô'=>'o','ồ'=>'o','ố'=>'o','ộ'=>'o','ổ'=>'o','ỗ'=>'o',
            'ơ'=>'o','ờ'=>'o','ớ'=>'o','ợ'=>'o','ở'=>'o','ỡ'=>'o',
            'ù'=>'u','ú'=>'u','ụ'=>'u','ủ'=>'u','ũ'=>'u',
            'ư'=>'u','ừ'=>'u','ứ'=>'u','ự'=>'u','ử'=>'u','ữ'=>'u',
            'ỳ'=>'y','ý'=>'y','ỵ'=>'y','ỷ'=>'y','ỹ'=>'y',
            'đ'=>'d',
            'À'=>'A','Á'=>'A','Ạ'=>'A','Ả'=>'A','Ã'=>'A',
            'Â'=>'A','Ầ'=>'A','Ấ'=>'A','Ậ'=>'A','Ẩ'=>'A','Ẫ'=>'A',
            'Ă'=>'A','Ằ'=>'A','Ắ'=>'A','Ặ'=>'A','Ẳ'=>'A','Ẵ'=>'A',
            'È'=>'E','É'=>'E','Ẹ'=>'E','Ẻ'=>'E','Ẽ'=>'E',
            'Ê'=>'E','Ề'=>'E','Ế'=>'E','Ệ'=>'E','Ể'=>'E','Ễ'=>'E',
            'Ì'=>'I','Í'=>'I','Ị'=>'I','Ỉ'=>'I','Ĩ'=>'I',
            'Ò'=>'O','Ó'=>'O','Ọ'=>'O','Ỏ'=>'O','Õ'=>'O',
            'Ô'=>'O','Ồ'=>'O','Ố'=>'O','Ộ'=>'O','Ổ'=>'O','Ỗ'=>'O',
            'Ơ'=>'O','Ờ'=>'O','Ớ'=>'O','Ợ'=>'O','Ở'=>'O','Ỡ'=>'O',
            'Ù'=>'U','Ú'=>'U','Ụ'=>'U','Ủ'=>'U','Ũ'=>'U',
            'Ư'=>'U','Ừ'=>'U','Ứ'=>'U','Ự'=>'U','Ử'=>'U','Ữ'=>'U',
            'Ỳ'=>'Y','Ý'=>'Y','Ỵ'=>'Y','Ỷ'=>'Y','Ỹ'=>'Y',
            'Đ'=>'D'
        ];
        $string = strtr($string, $map);
        return Str::slug($string);
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
        $grid->column('summary', __('Summary'))->display(function ($smr) {
            return mb_substr($smr, 0, 40);
        });
        $grid->column('description', __('Description'))->display(function ($smr) {
            return mb_substr($smr, 0, 100);
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

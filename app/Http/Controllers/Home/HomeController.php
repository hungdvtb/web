<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Category_Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Review;

class HomeController extends Controller
{


    public function review(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $bookId = $request->input('book_id');
        $sessionKey = 'reviewed_book_' . $bookId;

        //Kiểm tra xem session đã lưu đánh giá chưa
        if (session()->has($sessionKey)) {
            return response()->json(['message' => 'Bạn đã đánh giá truyện này rồi.'], 400);
        }

        // Tạo review
        Review::create([
            'book_id' => $bookId,
            'rating' => $request->input('rating')
        ]);
        $book = Book::find($bookId);
        $total = $book->rating_count;
        $avg = $book->average_rating;

        $newCount = $total + 1;
        $newAverage = (($avg * $total) + $request->rating) / $newCount;

        $book->rating_count = $newCount;
        $book->average_rating = round($newAverage, 2);
        $book->save();

        // Đánh dấu đã review trong session
        session()->put($sessionKey, true);

       return json_encode([
            'message' => 'Cảm ơn bạn đã đánh giá!',
            'average_rating' => $book->average_rating,
            'rating_count' => $book->rating_count
       ]);
    }
    public function index()
    {
        $books = Book::where('active', '=', 1)->orderBy('id', 'desc')->limit(20)->get();
        $cate = Category::where('active', '=', 1)->orderBy('id', 'desc')->get();
        $slides = Book::where('active', '=', 1)->where('hot_book', '=', 1)->orderBy('id', 'desc')->get();
        return view('frontend.pages.home', [
            'title' => 'Home',
            'categories' => $cate,
            'books' => $books,
            'slides' => $slides
        ]);
    }

    //filter
    public function filteredChar($char = '', Request $request)
    {
        $books = Book::where('active', '=', 1)->where('name', 'LIKE', '%' . $char . '%')->orderBy('id', 'desc')->paginate(15);
        $cate = Category::where('active', '=', 1)->orderBy('id', 'desc')->get();
        $slides = Book::where('active', '=', 1)->where('hot_book', '=', 1)->orderBy('id', 'desc')->get();
        return view('frontend.pages.fillter', [
            'title' => 'Home',
            'categories' => $cate,
            'books' => $books,
            'slides' => $slides
        ]);
    }

    //tabCate
    public function tabCate(Request $request)
    {
        $html = "";
        if ($request->ajax()) {
            $data = $request->all();
            $book_cate = Category::with('bookss')->where('id', '=', $data['id'])->get();
            foreach ($book_cate as $book) {
                foreach ($book->bookss as $book_) {
                    $html .= "<div class='col'>
                    <div class='card shadow-sm'>
                        <a href='" . route('doc-truyen', ['slug' => $book_->slug]) . "'><img class='card-img-top' width='80px' src='" . $book_->thumb . "' alt=''></a>
                      <div class='card-body'>
                          <h5>" . $book_->name . "</h5>
                        <div class='card-text'>
                        <div class='card-text'>$book_->summary</div>
                        </div>
                        <div style='width: 100%;' class='mt-2 d-flex justify-content-between'>
                          <a href='' class='btn btn-sm btn-outline-secondary'><i class='fa-solid fa-eye'></i> " . $book_->views . "</a>
                          <a href='" . route('doc-truyen', ['slug' => $book_->slug]) . "' class='btn btn-sm btn-outline-secondary'>Đọc Ngay</a>
                          <small class='mp-2 d-flex justify-content-center text-muted'>Cập Nhật: " . $book_->updated_at->diffForHumans() . "</small>
                        </div>
                      </div>
                    </div>
                  </div>";
                }
            }
        }

        return $html;
    }

    public function danhmuc($slug = '')
    {
        $category_id = Category::where('slug', '=', $slug)->select('id')->first();
        $category_name = Category::where('slug', '=', $slug)->select('name')->first();
        $slides = Book::where('active', '=', 1)->where('hot_book', '=', 1)->orderBy('id', 'desc')->get();
        $books = Book::where('active', '=', 1)->where('category_id', '=', $category_id->id)->orderBy('id', 'desc')->get();
        return view('frontend.pages.category', [
            'title' => $category_name->name,
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => $books,
            'slides' => $slides,
            'cates' => Category::where('slug', '=', $slug)->first()
        ]);
    }
    public function incrementReadCountWithSession(Chapter $chapter)
    {
        $chapterKey = 'read_chapter_' . $chapter->id;
        $bookKey = 'read_book_' . $chapter->book_id;

        $now = Carbon::now();

        // Kiểm tra nếu session chưa có hoặc đã quá 1 phút
        if (!Session::has($chapterKey) || $now->diffInMinutes(Session::get($chapterKey)) >= 1) {
            $chapter->book()->increment('views');

            // Cập nhật lại thời gian đọc gần nhất vào session
            Session::put($chapterKey, $now);
            Session::put($bookKey, $now);
        }
    }
    public function detail($slug = '')
    {
        $book = Book::where('slug', '=', $slug)
            ->with([
                'chapters' => function ($query) {
                    $query->select('id', 'slug', 'name', 'book_id', 'created_at');
                }
            ])->first();
        $sessionKey = 'reviewed_book_' . $book->id;
        $reviewed = session()->has($sessionKey);
        return view('frontend.pages.book', [
            'reviewed'=> $reviewed,
            'book' => $book
        ]);
    }

    public function chapter($bookslug = '', $slug = '')
    {
        $book = Book::where('slug', '=', $bookslug)->first();
        //breadcrumb 

        $chapter = Chapter::where('slug', '=', $slug)->with(['book'=>function($query){
            $query->with('chapters');
        }])->where('book_id', '=', $book->id)->first();
         
       
        return view('frontend.pages.chapter', [
            'chapter' => $chapter,
            'book'=> $chapter->book
        ]);
    }

    public function Search()
    {
        $keywords = $_GET['keyword'];
        $books = Book::where('name', 'LIKE', '%' . $keywords . '%')->orWhere('author', 'LIKE', '%' . $keywords . '%')->get();
        return view('frontend.pages.search', [
            'title' => "Tìm Kiếm",
            'categories' => Category::where('active', '=', 1)->orderBy('id', 'desc')->get(),
            'books' => $books,
        ]);
    }

    public function SearchAjax(Request $request)
    {
        $html = "";
        $data = $request->all();
        if ($data['keywords']) {
            $book = Book::where('active', '=', 1)->where('name', 'LIKE', '%' . $data['keywords'] . '%')->get();
            $html .= "<ul class='dropdown-menu show' style='position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-213px, 40px, 0px);'>";

            if ($book == true) {
                foreach ($book as $b) {
                    $html .= "<li class='dropdown-item'>
                        <a style='text-decoration: none;' href='" . route('doc-truyen', ['slug' => $b->slug]) . "'>" . $b->name . "</a>
                    </li>";
                }
            } else if ($data['keywords'] == '') {
                $html .= "<li class='dropdown-item'>
                <a style='text-decoration: none;' href=''>Không Tìm Thấy</a>
                </li>";
            }
            $html .= "</ul>";
        }
        return Response($html);
    }
}

<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;
use App\Models\Category;
class HomeController extends Controller
{
    public function index(Content $content)
    {
        $data = [];
        $data['categories'] = Category::all()->toArray();
        return $content
            ->view('admin.dashboard', $data);
    }
}

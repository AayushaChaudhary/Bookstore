<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $count = [
            'book' => Book::count(),
            'category' => Category::count(),
            'author' => Author::count(),
            'publisher' => Publisher::count(),
            'user' => User::count(),
        ];
        return view('admin.index', compact('count'));
    }
}

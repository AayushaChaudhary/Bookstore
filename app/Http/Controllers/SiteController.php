<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Message;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $recent_books = Book::orderBy('id', 'DESC')->take(4)->get();

        return view('frontend.index', compact('recent_books'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactForm(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required'],
        ]);

        Message::create($data);

        return redirect()->route('contact')->with('success', 'You message has been sent! Thank you!');
    }

    public function home()
    {
        if (auth()->user()->role == "Admin") {
            return redirect('/admin');
        }

        return redirect('/');
    }
}

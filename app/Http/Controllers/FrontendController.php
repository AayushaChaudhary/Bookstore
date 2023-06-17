<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use setasign\Fpdi\Fpdi;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $recent_books = Book::query()
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();

        $authors = Author::inRandomOrder()
            ->with('books')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('frontend.index', compact('recent_books', 'authors'));
    }

    // All Categories (List)
    public function categories()
    {
        $categories = Category::query()
            ->orderBy('name', 'ASC')
            ->withCount('books')
            ->get();

        return view('frontend.categories', compact('categories'));
    }

    // Get Book Data (Dynamic Fetching: Search, Author, Category)
    public function getBooks(Request $request, ?Category $category = null, ?Author $author = null)
    {
        // Get By Author
        if (!empty($author)) {
            $query = Book::where('author_id', $author->id);
        } else {
            $query = Book::query();
        }

        // Search
        if (!empty($request->q)) {
            $search = trim(strip_tags($request->q));
            $query = $query->where('name', 'LIKE', '%' . $search . '%');
        }

        // Get By Category
        if (!empty($category)) {
            $query = $query->where('category_id', $category->id);
        }

        $query = $query->with(['category']);

        return $query->get();
    }

    // Search Products
    public function search(Request $request)
    {
        if (empty($request->q)) {
            return redirect()->route('books');
        }

        $search = trim(strip_tags($request->q));
        $title = "Searching for: '$search'";
        $books = $this->getBooks($request);

        return view('frontend.books', compact('books', 'title', 'search'));
    }

    // Get All Books (With Search and Query)
    public function books(Request $request)
    {
        $books = $this->getBooks($request);
        $title = "All Books";
        $search = null;

        if (!empty($request->q)) {
            $search = trim(strip_tags($request->q));
            $title = "Searching for: '$search'";
        }

        return view('frontend.books', compact('books', 'title', 'search'));
    }

    public function book(Book $book)
    {
        $related_books = Book::query()
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->limit(4)
            ->get();

        return view('frontend.show-book', compact('book', 'related_books'));
    }

    // Books by Category
    public function category(Request $request, Category $category)
    {
        $books = $this->getBooks($request, $category);
        $title = "All $category->name Books";
        $search = null;

        if (!empty($request->q)) {
            $search = trim(strip_tags($request->q));
            $title = "Searching for: '$search' in $category->name";
        }

        return view('frontend.books', compact('books', 'title', 'search'));
    }

    // Books by Author
    public function author(Request $request, Author $author)
    {
        $books = $this->getBooks($request, null, $author);
        $title = "Books by '$author->name'";
        $search = "";

        if (!empty($request->q)) {
            $search = trim(strip_tags($request->q));
            $title = "Searching for: '$search' Written By $author->name";
        }

        return view('frontend.books', compact('books', 'title', 'search'));
    }

    // Latest Books
    public function arrivals()
    {
        $books = Book::query()
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $search = null; // no search here
        $title = "Latest Arrivals";

        return view('frontend.books', compact('books', 'title', 'search'));
    }

    public function error()
    {
        return view('frontend.errors');
    }

    public function preview(Book $book)
    {
        $max_page = 2;  // change for maximum page on preview

        $pdf = new Fpdi();

        if (empty($book->sample_pdf_id) || !$book->pdf) {
            $pdf->addPage();
            $pdf->SetFont('Helvetica');
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(30, 30);
            $pdf->Write(0, 'No Sample PDF Found!');
            $pdf->output();
            return;
        }

        // Else Load the PDF
        try {
            if (DIRECTORY_SEPARATOR === '\\') {
                $path = storage_path() . "\\app\\public\\" . $book->pdf->path;
            } else {
                $path = storage_path() . "/app/public/" . $book->pdf->path;
            }

            $pdf->setSourceFile($path);
            for ($i = 1; $i <= $max_page; $i++) {
                $template = $pdf->importPage($i);
                $pdf->AddPage();
                $pdf->useTemplate($template);
            }

            $pdf->addPage();
            $pdf->SetFont('Helvetica');
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(30, 30);
            $pdf->Write(5, "--END OF SAMPLE--");

            $pdf->output();
        } catch (\Exception $e) {
            $pdf = new Fpdi();
            $pdf->addPage();
            $pdf->SetFont('Helvetica');
            $pdf->SetTextColor(255, 0, 0);
            $pdf->SetXY(30, 30);
            $pdf->Write(5, "Sorry, we could not load the sample PDF File!");
            $pdf->output();
        }
    }
}

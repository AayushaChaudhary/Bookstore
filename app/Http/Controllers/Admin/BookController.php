<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Stock;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::withSum('stocks', 'quantity')->get();

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('admin.books.create', compact('categories', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'edition' => ['required'],
            'type' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'on_sale' => ['boolean'],
            'sale_price' => ['nullable', 'required_if:on_sale,1', 'integer', 'lt:price'],
            'description' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'publisher_id' => ['required', 'exists:publishers,id'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'sample_file' => ['nullable', 'mimetypes:application/pdf'],
            'initial_stock' => ['nullable', 'integer', 'gte:0'],
        ]);

        if ($request->hasFile('image')) {
            $media_id = MediaService::upload($request->file('image'), "books");
        }

        if ($request->hasFile('sample_pdf')) {
            $pdf_id = MediaService::upload($request->file('sample_pdf'), "pdf");
        }

        $book = Book::create([
            'name' => $request->name,
            'edition' => $request->edition,
            'type' => $request->type,
            'price' => $request->price,
            'on_sale' => $request->on_sale ? true : false,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'media_id' => $media_id ?? null,
            'sample_pdf_id' => $pdf_id ?? null,
        ]);

        if (!empty($request->initial_stock) && $request->initial_stock > 0) {
            Stock::create([
                'book_id' => $book->id,
                'quantity' => $request->initial_stock,
                'remarks' => 'Initial Stock',
            ]);
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('admin.books.edit', compact('book', 'categories', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'edition' => ['required'],
            'type' => ['required'],
            'price' => ['required', 'integer', 'min:0'],
            'on_sale' => ['boolean'],
            'sale_price' => ['nullable', 'required_if:on_sale,1', 'integer', 'lt:price'],
            'description' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
            'publisher_id' => ['required', 'exists:publishers,id'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'sample_file' => ['nullable', 'mimetypes:application/pdf'],
        ]);

        if ($request->hasFile('image')) {
            if ($book->media_id && $book->media) {
                Storage::delete("public/" . $book->media->path);
            }

            $media_id = MediaService::upload($request->file('image'), "books");
        }

        if ($request->hasFile('sample_pdf')) {
            if ($book->sample_pdf_id && $book->pdf) {
                Storage::delete("public/" . $book->pdf->path);
            }

            $pdf_id = MediaService::upload($request->file('sample_pdf'), "pdf");
        }

        $book->update([
            'name' => $request->name,
            'edition' => $request->edition,
            'type' => $request->type,
            'price' => $request->price,
            'on_sale' => $request->on_sale ? true : false,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'media_id' => $media_id ?? $book->media_id,
            'pdf_id' => $pdf_id ?? $book->pdf_id,
        ]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->media_id && $book->media) {
            Storage::delete("public/" . $book->media->path);
        }

        if ($book->sample_pdf_id && $book->pdf) {
            Storage::delete("public/" . $book->pdf->path);
        }
    }
}

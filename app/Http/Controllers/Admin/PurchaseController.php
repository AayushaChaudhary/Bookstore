<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();

        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        $suppliers = Supplier::all();

        return view('admin.purchases.create', compact('books', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'quantity'  => ['required', 'integer', 'gt:0'],
            'price' => ['required', 'integer', 'gt:0'],
        ]);

        DB::transaction(function () use ($data) {
            Purchase::create($data);
            $supplier = Supplier::find($data['supplier_id']);

            Stock::create([
                'book_id' => $data['book_id'],
                'quantity' => $data['quantity'],
                'remarks' => 'Purchase from: ' . $supplier->name,
            ]);
        });

        return redirect()->route('admin.purchases.index')
            ->with('success', 'New purchase has been recorded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        DB::transaction(function () use ($purchase) {

            // Remove Stock when removing purchase
            Stock::create([
                'book_id' => $purchase->book_id,
                'quantity' => $purchase->quantity * -1,
                'remarks' => 'Delete Purchase from: ' . $purchase->supplier->name,
            ]);

            $purchase->delete();
        });

        return redirect()->route('admin.purchases.index')
            ->with('success', 'Purchase history has been deleted successfully!');
    }
}

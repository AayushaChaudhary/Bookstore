<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view('admin.orders.index', Compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'User')->get();
        $books = Book::all();

        return view('admin.orders.create', compact('users', 'books'));
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
            'user_id' => ['required', 'exists:users,id'],
            'book_id' => ['required', 'exists:books,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $order = Order::create([
            'user_id' => $request->user_id
        ]);

        $book = Book::find($request->book_id);

        BookOrder::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'unit_price' => $book->on_sale ? $book->sale_price : $book->price,
        ]);

        return redirect()->route('admin.orders.show', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $book_orders = BookOrder::where('order_id', $order->id)
            ->with(['book'])
            ->get();
        $books = Book::all();

        return view('admin.orders.show', compact('order', 'book_orders', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function addBook(Request $request, Order $order)
    {
        if (!$order->can_update) {
            return redirect()->route('admin.orders.show', $order)
                ->with('error', 'This order has been marked as ' . $order->status . '! No further modification could be made!');
        }

        $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $book = Book::find($request->book_id);

        // Check if book is already added to order or not
        $check = BookOrder::where('order_id', $order->id)
            ->where('book_id', $book->id)
            ->first();

        if ($check) {
            // If found, add quantity instead of adding another item to order
            $check->update(['quantity' => $check->quantity + $request->quantity]);

            return redirect()->route('admin.orders.show', $order)
                ->with('success', $request->quantity . ' quantity have been added to the order of book: ' . $book->name . '!');
        }

        // If not, proceed as planned to add item to order
        BookOrder::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'unit_price' => $book->on_sale ? $book->sale_price : $book->price,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Book has been added to the order!');
    }

    public function editQuantity(Order $order, BookOrder $book_order)
    {
        if (!$order->can_update) {
            return redirect()->route('admin.orders.show', $order)
                ->with('error', 'This order has been marked as ' . $order->status . '! No further modification could be made!');
        }

        return view('admin.orders.quantity', compact('order', 'book_order'));
    }

    public function updateQuantity(Request $request, Order $order, BookOrder $book_order)
    {
        if (!$order->can_update) {
            return redirect()->route('admin.orders.show', $order)
                ->with('error', 'This order has been marked as ' . $order->status . '! No further modification could be made!');
        }

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $book_order->update(['quantity' => $request->quantity]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Book has been added to the order!');
    }

    public function deleteBook(Request $request, Order $order, BookOrder $book_order)
    {
        if (!$order->can_update) {
            return redirect()->route('admin.orders.show', $order)
                ->with('error', 'This order has been marked as ' . $order->status . '! No further modification could be made!');
        }

        $book_order->delete();

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Book has been removed from the order!');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', Rule::in(Order::STATUS)],
        ]);

        if ($order->status == $request->status) {
            return redirect()->route('admin.orders.show', $order);
        }

        // If Status Is Complete, Remove Stock
        if ($request->status == "Complete") {
            $books = BookOrder::where('order_id', $order->id)->get();
            foreach ($books as $b) {
                Stock::create([
                    'book_id' => $b->book_id,
                    'remarks' => 'From Order #' . $order->id,
                    'quantity' => $b->quantity * -1,
                ]);
            }
        }

        if ($request->status == "Refunded") {
            $books = BookOrder::where('order_id', $order->id)->get();
            foreach ($books as $b) {
                Stock::create([
                    'book_id' => $b->book_id,
                    'remarks' => 'Refund from Order #' . $order->id,
                    'quantity' => $b->quantity,
                ]);
            }
        }


        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status has been updated to: ' . $request->status);
    }
}

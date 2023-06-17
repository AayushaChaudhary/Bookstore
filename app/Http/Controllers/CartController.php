<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use App\Notifications\BookupdateNotification;
use App\Notifications\OrderconformationNotification;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('frontend.cart', compact('carts'));
    }

    public function create(Book $book, Request $request)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'gte:1'],
        ]);

        if (empty($request->quantity)) {
            $quantity = 1;
        } else {
            $quantity = $request->quantity;
        }

        $cart_exist = Cart::query()
            ->where([
                'user_id' => auth()->id(),
                'book_id' => $book->id
            ])
            ->first();

        if ($cart_exist) {
            $cart_exist->update([
                'quantity' => $quantity + $cart_exist->quantity
            ]);
        } else {
            Cart::create([
                'user_id'       => auth()->id(),
                'book_id'       => $book->id,
                'quantity'      => $quantity,
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Book has been added to cart!');
    }

    public function quantity(Cart $cart, Request $request)
    {
        if ($cart->user_id != auth()->id()) {
            abort(403, "You do not own this cart!");
        }

        $request->validate([
            'quantity' => ['required', 'integer'],
        ]);

        if ($request->quantity <= 0) {
            $cart->delete();
        } else {
            $cart->update(['quantity' => $request->quantity]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Quantity of item has been updated successfully!');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id != auth()->id()) {
            abort(403, "You do not own this cart!");
        }

        $cart->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Cart item has been removed successfully!');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        if (count($carts) == 0) {
            return redirect()->route('cart.index')
                ->with('error', 'You do not have any items in your cart! Explore some books and add them to your cart!');
        }

        return view('frontend.checkout', compact('carts'));
    }

    public function placeOrder(Request $request)
    {
        $carts = Cart::where('user_id', auth()->id())->with('book')->get();

        if (count($carts) == 0) {
            return redirect()->route('cart.index')
                ->with('error', 'You do not have any items in your cart to proceed to checkout!');
        }

        $data = $request->validate([
            'shipping_name' => ['required', 'regex:/^[a-zA-z ]{1,}$/'],
            'shipping_address' => ['required'],
            'shipping_phone' => ['required', 'numeric', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'shipping_notes' => ['nullable'],
            'same_info' => ['nullable', 'boolean'],
            'billing_name' => ['nullable', 'required_without:same_info'],
            'billing_address' => ['nullable', 'required_without:same_info'],
            'billing_phone' => ['nullable', 'required_without:same_info', 'numeric', 'digits:10', 'regex:/((98)|(97))(\d){8}/'],
            'billing_notes' => ['nullable', 'required_without:same_info'],
        ]);

        // If same info, copy from shipping address to billing address
        if ($request->same_info) {
            $data['billing_name'] = $request->shipping_name;
            $data['billing_address'] = $request->shipping_address;
            $data['billing_phone'] = $request->shipping_phone;
            $data['billing_notes'] = $request->shipping_notes;
        }

        $data['user_id'] = auth()->id();

        $order = Order::create($data);

        foreach ($carts as $item) {
            $book = $item->book;
            BookOrder::create([
                'book_id'       => $item->book_id,
                'order_id'      => $order->id,
                'quantity'      => $item->quantity,
                'unit_price'    => $book->on_sale ? $book->sale_price : $book->price,
            ]);
        }

        //Notification
        auth()->user()->notify(new OrderconformationNotification);
        // $user()->user()->notify(new BookupdateNotification);

        // Clear Cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Your order has been placed successfully!');
    }
}

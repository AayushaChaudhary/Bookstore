<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('frontend.profile.index', compact('user'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('bookOrders')
            ->with('bookOrders.book')
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('frontend.orders.index', compact('orders'));
    }

    public function order(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        return view('frontend.orders.show', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        if (!in_array($order->status, ['Pending', 'Confirmed'])) {
            return redirect()->route('profile.orders')
                ->with('error', 'You cannot cancel this order!');
        }

        $order->update(['status' => 'Cancel']);

        return redirect()->route('profile.orders')
            ->with('success', 'Your order has been canceled!');
    }

    public function edit()
    {
        $user = auth()->user();

        return view('frontend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            // 'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
        ]);

        // unset($data['image']);
        // if ($request->hasFile('image')) {
        //     $data['media_id'] = MediaService::upload($request->file('image'));
        //     if ($user->media_id && $user->media) {
        //         Storage::delete($user->media->path);
        //     }
        // }

        auth()->user()->update($data);

        return redirect()->route('profile.index')
            ->with('success', 'Profile Updated Successfully!');
    }

    public function password()
    {
        return view('frontend.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'  => ['required', 'current_password'],
            'password'          => ['required', 'confirmed', 'min:6'],
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Password updated successfully!');
    }
}

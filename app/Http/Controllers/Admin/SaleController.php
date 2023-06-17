<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Order::where('status', 'Complete')
            ->orderBy('id', 'DESC')->get();

        return view('admin.sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Order::findOrFail($id);

        if ($sale->status != "Complete") {
            return redirect()->route('admin.orders.show', $sale)
                ->with('error', 'This order is not complete!');
        }

        return view('admin.sales.show', compact('sale'));
    }
}

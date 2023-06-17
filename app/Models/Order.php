<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'billing_name',
        'shipping_name',
        'billing_address',
        'shipping_address',
        'billing_phone',
        'shipping_phone',
        'billing_notes',
        'shipping_notes',
    ];

    const STATUS = [
        'Pending', 'Confirmed', 'Delivering', 'Delivered', 'Complete', 'Canceled', 'Refunded',
    ];

    public function getCanUpdateAttribute()
    {
        return !in_array($this->status, ['Canceled', 'Refunded', 'Complete']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot(['quantity', 'unit_price']);
    }

    public function getTotalAmountAttribute()
    {
        $bo = \App\Models\BookOrder::where('order_id', $this->id)->get();
        $total = 0;
        foreach ($bo as $b) {
            $total += (int) $b->quantity * $b->unit_price;
        }

        return $total;
    }

    public function bookOrders()
    {
        return $this->hasMany(BookOrder::class);
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->bookOrders as $o) {
            $total += $o->unit_price * $o->quantity;
        }

        return $total;
    }

    public function getCanCancelAttribute()
    {
        return in_array($this->status, ['Pending', 'Confirmed']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'price', 'quantity', 'book_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}

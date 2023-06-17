<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'edition', 'type', 'price', 'on_sale', 'sale_price',
        'description', 'category_id', 'author_id', 'publisher_id',
        'media_id', 'sample_pdf_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function pdf()
    {
        return $this->belongsTo(Media::class, 'sample_pdf_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function getImageAttribute()
    {
        if ($this->media_id && $this->media) {
            return asset('/storage/' . $this->media->path);
        }

        return asset('/images/no-image.png');
    }

    public function getCurrentAmountAttribute()
    {
        return $this->on_sale ? $this->sale_price : $this->price;
    }
}

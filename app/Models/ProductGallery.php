<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id',
        'url'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/product/' . $value),
        );
    }

}

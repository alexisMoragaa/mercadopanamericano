<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_product_id',
        'image_path',
        'user_id',
    ];
    


    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }
}

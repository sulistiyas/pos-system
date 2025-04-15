<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = true;

    protected $fillable = [
        'product_name',
        'product_price',
        'product_stock',
        'id_category',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'id_product', 'id_product');
    }
}

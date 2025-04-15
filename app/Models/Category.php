<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $timestamps = true;

    protected $fillable = [
        'category_name',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'id_category', 'id_category');
    }
}

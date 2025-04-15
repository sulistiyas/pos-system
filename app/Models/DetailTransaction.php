<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detail_transactions';
    protected $primaryKey = 'id_detail_transaction';
    public $timestamps = true;

    protected $fillable = [
        'id_transaction',
        'id_product',
        'detail_transaction_qty',
        'detail_transaction_subtotal',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction', 'id_transaction');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'id_product', 'id_product');
    }
}

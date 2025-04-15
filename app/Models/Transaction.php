<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
    public $timestamps = true;

    protected $fillable = [
        'id_customer',
        'transaction_date',
        'transaction_total',
        'transaction_status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'id_product', 'id_product');
    }

    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class, 'id_transaction', 'id_transaction');
    }
}

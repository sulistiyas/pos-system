<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id_customer';
    public $timestamps = true;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
    ];

    // Define any relationships or additional methods here
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_customer', 'id_customer');
    }
    
}

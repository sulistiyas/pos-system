<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        unset($data['updated_at']);
        unset($data['id_category']);
        
        $transcation_data = static::getModel()::create([
            'id_customer' => $data['id_customer'],
            'transaction_date' => date('Y-m-d'),
            'transaction_total' => $data['detail_transaction_subtotal'],

            // 'transaction_status' => $data['transaction_status'],
        ]);

        $transcation_data->detailTransaction()->create([
            'id_transaction' => $transcation_data->id_transaction,
            'id_product' => $data['product_id'],
            'detail_transaction_qty' => $data['detail_transaction_qty'],
            'detail_transaction_subtotal' => $data['detail_transaction_subtotal'],
        ]);

        return $transcation_data;
    }
}

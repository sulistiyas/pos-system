<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id('id_detail_transaction');
            $table->bigInteger('id_transaction')->unsigned();
            $table->foreign('id_transaction')->references('id_transaction')->on('transactions')->onDelete('cascade');
            $table->bigInteger('id_product')->unsigned();
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->integer('detail_transaction_qty');
            $table->integer('detail_transaction_subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};

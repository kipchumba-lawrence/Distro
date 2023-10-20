<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // If you don't have a customer_id, you can remove the following lines
            // $table->unsignedBigInteger('customer_id');
            // $table->foreign('customer_id')->references('id')->on('customers');
            $table->decimal('total_amount', 10, 2);
            $table->string('attended_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

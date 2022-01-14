<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('quantity')->unsigned()->default(0);
            $table->dateTime('remaining_date')->nullable();
            $table->dateTime('end_date')->nullable(); 
            $table->dateTime('amended_at')->nullable(); 
            $table->timestamps();

            $table->foreign('store_id')->references('id')
            ->on('stores')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')
            ->on('customers')->onDelete('set null');
            $table->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

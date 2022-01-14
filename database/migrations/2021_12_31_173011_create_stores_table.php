<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 127);
            $table->string('phone', 50);
            $table->string('password');
            $table->text('image')->nullable();
            $table->text('commercial_register')->nullable();
            $table->unsignedInteger('emirate_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('street')->nullable();
            
            $table->timestamps();
            $table->foreign('emirate_id')->references('id')
            ->on('emirates')->onDelete('set null');
            $table->foreign('city_id')->references('id')
            ->on('cities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}

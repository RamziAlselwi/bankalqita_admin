<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->nullable();
            $table->string('code')->nullable();
            $table->text('cuases')->nullable();
            $table->text('others')->nullable();

            $table->foreign('category_id')->references('id')
            ->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropColumn('code');
            $table->dropColumn('cuases');
            $table->dropColumn('others');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftBoxProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_box_products', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_box_id')->comment('gift box id');
            $table->integer('product_id')->comment('product id');
            $table->integer('quantity')->comment('product quantity');
            $table->integer('created_by')->command('user\'s id create');
            $table->timestamps();
            $table->integer('updated_by')->command('user\'s id update');
            $table->softDeletes()->comment('soft delete timestamp');

            // add unique index
            $table->unique([
                'gift_box_id',
                'product_id',
            ], 'uuidx1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_box_products');
    }
}

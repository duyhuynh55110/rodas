<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->comment('brand id');
            $table->string('name', 100)->comment('product name');
            $table->string('image_file_name', 100)->comment('product image');
            $table->decimal('item_price', 18, 8)->default(0)->comment('product price');
            $table->integer('weight')->comment('brand id');
            $table->integer('created_by')->command('user\'s id create');
            $table->timestamps();
            $table->integer('updated_by')->command('user\'s id update');
            $table->softDeletes()->comment('soft delete timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

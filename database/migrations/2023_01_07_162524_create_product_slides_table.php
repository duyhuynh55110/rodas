<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_slides', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->comment('product\'s id');
            $table->string('image_file_name', 199)->unique()->comment('product\'s image slide');
            $table->integer('created_by')->command('user\'s id create');
            $table->timestamps();
            $table->integer('updated_by')->command('user\'s id update');
            $table->softDeletes();

            // add unique index
            $table->unique(['image_file_name'], 'uuidx1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_slides');
    }
}

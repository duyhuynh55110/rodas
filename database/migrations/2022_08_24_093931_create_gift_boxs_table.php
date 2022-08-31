<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftBoxsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_boxs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('gift box name');
            $table->string('image_file_name', 100)->comment('gift box image');
            $table->decimal('price', 18, 8)->default(0)->comment('gift box price');
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
        Schema::dropIfExists('gift_boxs');
    }
}

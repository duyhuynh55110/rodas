<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('user\'s id');
            $table->tinyInteger('status');
            $table->decimal('total_price', 18, 8)->comment('order total price of all products');
            $table->text('note')->nullable();
            $table->integer('created_by')->command('user\'s id create');
            $table->timestamps();
            $table->integer('updated_by')->command('user\'s id update');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_issues');
    }
}

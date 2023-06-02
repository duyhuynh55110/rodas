<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderIssueProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_issue_products', function (Blueprint $table) {
            $table->id();
            $table->integer('order_issue_id')->comment('order issue id');
            $table->integer('product_id')->comment('product id');
            $table->decimal('item_price', 18, 8);
            $table->integer('quantity');
            $table->decimal('amount', 18, 8);
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
        Schema::dropIfExists('order_issue_products');
    }
}

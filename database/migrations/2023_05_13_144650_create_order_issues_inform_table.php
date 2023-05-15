<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderIssuesInformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_issues_inform', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id');
            $table->integer('order_issue_id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('address', 255);
            $table->integer('zip_code');
            $table->string('city', 255);
            $table->integer('phone');
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
        Schema::dropIfExists('order_issues_inform');
    }
}

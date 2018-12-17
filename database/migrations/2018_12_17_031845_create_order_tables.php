<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->nullable();
            $table->integer('total')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->integer('parent_id')->nullable();
            $table->unsignedInteger('store_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('staff_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('staff_id')->references('id')->on('staffs');
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->default(1);
            $table->integer('price');
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->integer('reason')->nullable();
            $table->unsignedInteger('bill_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('service_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('service_id')->references('id')->on('services');
        });

        Schema::create('order_detail_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('extra_value')->nullable();
            $table->string('extra_name')->nullable();
            $table->string('extra_price')->nullable();
            $table->unsignedInteger('order_detail_id');
            $table->unsignedInteger('extra_id');
            $table->foreign('order_detail_id')->references('id')->on('order_details');
            $table->foreign('extra_id')->references('id')->on('extras');
        });

        Schema::create('timelines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action')->nullable();
            $table->text('data')->nullable();
            $table->time('time')->nullable();
            $table->integer('authorable_id');
            $table->string('authorable_type');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
        });

        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount')->nullable();
            $table->date('date_to_out')->nullable();
            $table->date('date_to_join')->nullable();
            $table->text('data')->nullable();
            $table->integer('quantity')->nullable();
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('staff_id')->references('id')->on('staffs');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('order_detail_options');
        Schema::dropIfExists('timelines');
        Schema::dropIfExists('bills');
    }
}

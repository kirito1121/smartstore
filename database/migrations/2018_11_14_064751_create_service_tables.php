<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('service_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id')->nullable();
            $table->integer('index')->nullable();
            $table->timestamps();
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->integer('price_promotion')->nullable();
            $table->boolean('all')->default(true);
            $table->integer('time')->nullable();
            $table->integer('index')->nullable();
            $table->boolean('hot')->default(false);
            $table->timestamps();
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('service_group_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('service_group_id')->references('id')->on('service_groups');
        });

        Schema::create('combos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->integer('price_promotion')->nullable();
            $table->boolean('all')->default(true);
            $table->integer('time')->nullable();
            $table->integer('index')->nullable();
            $table->boolean('hot')->default(false);
            $table->timestamps();
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('service_group_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('service_group_id')->references('id')->on('service_groups');
        });

        Schema::create('combo_has_services', function (Blueprint $table) {
            $table->unsignedInteger('combo_id');
            $table->foreign('combo_id')->references('id')->on('combos');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->integer('quantity_service');
            $table->text('extras')->nullable();
        });

        Schema::create('extras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('once')->default(false);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
        Schema::create('extra_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('extra_id');
            $table->foreign('extra_id')->references('id')->on('extras');
        });

        Schema::create('service_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedInteger('extra_id');
            $table->foreign('extra_id')->references('id')->on('extras');
            $table->string('value');
            $table->integer('price');
            $table->boolean('active')->default(true);
            $table->boolean('default')->default(false);
        });
        Schema::create('store_options', function (Blueprint $table) {
            $table->boolean('action');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('extra_id');
            $table->unsignedInteger('service_option_id');
            $table->unsignedInteger('combo_id');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('extra_id')->references('id')->on('extras');
            $table->foreign('service_option_id')->references('id')->on('service_options');
            $table->foreign('combo_id')->references('id')->on('combos');
        });

        Schema::create('service_specials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->integer('price');
            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('day_of_week')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('all')->default(false);
            $table->unsignedInteger('store_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('store_id')->references('id')->on('stores');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('units');
        Schema::drop('services');
        Schema::drop('combos');
        Schema::drop('combo_details');
        Schema::drop('extras');
        Schema::drop('extra_options');
    }
}

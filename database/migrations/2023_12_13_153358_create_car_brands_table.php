<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_brands', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("car_company_id")->comment("汽车品牌的归属公司");
            $table->string("title")->comment("汽车品牌名称");
            $table->string("description")->comment("汽车品牌描述");
            $table->string("short_name")->comment("汽车品牌简称");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_brands');
    }
};

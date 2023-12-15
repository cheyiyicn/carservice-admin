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
        Schema::create('car_brand_series', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("car_brand_id")->comment("汽车品牌 ID");
            $table->string("title")->comment("汽车品牌系列名称");
            $table->string("english_title")->comment("汽车品牌系列英文名称");
            $table->string("dealer_price")->comment("汽车品牌车系经销商价格")->comment("");
            // ! create a new migration if needed.
            // $table->decimal("dealer_price_min", 10, 2)->comment("经销商价格下限");
            // ! create a new migration if needed.
            // $table->decimal("dealer_price_max", 10, 2)->comment("经销商价格上限");
            $table->string("offical_price")->comment("汽车品牌车系官方价格")->comment("");
            // ! create a new migration if needed.
            // $table->decimal("offical_price_min", 10, 2)->comment("官方价格下限");
            // ! create a new migration if needed.
            // $table->decimal("offical_price_max", 10, 2)->comment("官方价格上限");
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
        Schema::dropIfExists('car_brand_series');
    }
};

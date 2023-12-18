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
        // ! This table is special that the field name is contains prefix of `series_`.
        Schema::create('car_brand_series', function (Blueprint $table) {
            $table->id("series_id");
            $table->bigInteger("brand_id")->comment("直属品牌");
            $table->string("series_name")->comment("品牌系列名称");
            $table->string("sub_brand_name")->nullable()->default("")->comment("子品牌名称");
            $table->string("image_url")->default("")->comment("图片");
            $table->decimal("official_price_up")->default(0.00)->comment("官方最高售价");
            $table->string("official_price")->default("")->comment("官方售价区间字符串");
            $table->decimal("official_price_down")->default(0.00)->comment("官方最低售价");
            $table->decimal("dealer_price_up")->default(0.00)->comment("经销商最高售价");
            $table->string("dealer_price")->default("")->comment("经销商售价字符串");
            $table->decimal("dealer_price_down")->default(0.00)->comment("经销商最低售价");
            $table->string("category_name")->default("")->comment("汽车分类");
            $table->tinyInteger("business_status")->comment("是否正在营业");
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

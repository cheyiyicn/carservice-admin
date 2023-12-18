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
        // car_brands 汽车品牌
        // ! This table is special that the field name is contains prefix of `brand_`.
        // todo: change fk of the relation model.
        // ❌ car_company_id 包含所属的汽车厂商 / 公司
        Schema::create('car_brands', function (Blueprint $table) {
            $table->id("brand_id"); // ! It's increment key of specially naming.
            $table->tinyInteger("business_status")->comment("是否正在营业");
            $table->string("image_url")->nullable()->comment("车标");
            $table->string("brand_name")/*->charset("GB2312")*/->comment("品牌名称");
            $table->string("brand_english_name")->default("")->comment("品牌英文名称");
            $table->string("brand_type")/*->charset("GB2312")*/->default("")->comment("车系");
            $table->string("brand_country")/*->charset("GB2312")*/->default("")->comment("车辆所属国家");
            $table->text("content_abstract")/*->charset("GB2312")*/->nullable()->comment("描述");
            $table->char("pinyin", 1)->default("")->comment("拼音 (或拼音首字母)");
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

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
        Schema::create('partner_stores', function (Blueprint $table) {
            $table->id();
            $table->string("title")->comment("合作门店名称");
            $table->string("short_title")->comment("合作门店短名称");
            $table->string("english_title")->comment("合作门店英文名称");
            $table->string("store_number")->comment("合作门店编号");
            $table->string("address")->comment("合作门店地址");
            $table->string("full_address")->comment("合作门店完整地址");
            $table->string("phone_number")->comment("合作门店负责人电话");
            $table->decimal("longitude")->comment("合作门店实际经度");
            $table->decimal("latitude")->comment("合作门店实际纬度");
            $table->string("position")->comment("经纬度集合")->default("");
            $table->string("description")->comment("合作门店描述");
            $table->longText("html_description")->comment("合作门店描述 HTML");
            $table->tinyInteger("status")->comment("合作门店使用状态");
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
        Schema::dropIfExists('partner_stores');
    }
};

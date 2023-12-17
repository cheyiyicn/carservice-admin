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
        // ×car_company_id 包含所属的汽车厂商 / 公司
        Schema::create('car_brands', function (Blueprint $table) {
            $table->id();
            /**
             * @deprecated delete this.
             */
            $table->string("title")->comment("汽车品牌名称");
            $table->string("english_title")->comment("汽车品牌英文名称")->default("");
            $table->string("short_title")->comment("汽车品牌简称")->default("");
            $table->string("type")->comment("品牌类型")->default("");
            $table->string("description")->comment("汽车品牌描述")->default("");
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

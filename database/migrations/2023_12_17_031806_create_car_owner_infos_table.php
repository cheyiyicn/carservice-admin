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
        // 用户车主信息 //
        Schema::create('car_owner_infos', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("车主姓名");
            $table->string("phone_number")->comment("车主手机号码");
            $table->string("province")->default("")->comment("省份");
            $table->string("city")->default("")->comment("城市");
            $table->string("districts")->default("")->comment("区");
            $table->string("multilevel_address")->default("")->comment("多级地址, `-` 分隔");
            $table->string("comment")->default("")->comment("车主留言");
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
        Schema::dropIfExists('car_owner_infos');
    }
};

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
        Schema::create('car_replacements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("parent_id");
            $table->string("title");
            // 高端
            $table->decimal("hm_est_f32_price"); // 浮点
            $table->unsignedBigInteger("hm_est_u64_price"); // 整型
            // 低端
            $table->decimal("lm_est_f32_price"); // 浮点
            $table->unsignedBigInteger("lm_est_u64_price"); // 整型
            $table->integer("counter")->default(1);
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
        Schema::dropIfExists('car_replacements');
    }
};

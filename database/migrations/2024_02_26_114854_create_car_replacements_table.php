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
            $table->decimal("est_f32_price"); // 浮点
            $table->unsignedBigInteger("est_u64_price"); // 整型
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

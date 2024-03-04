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
        Schema::create('order_comments', function (Blueprint $table) {
            $defaultMaxRate = 5;
            $table->id();
            $table->unsignedBigInteger("order_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamp("published_at")->nullable();
            // ? if need the below column?
            $table->string("title")->nullable();
            $table->unsignedTinyInteger("rate")->default($defaultMaxRate);
            $table->string("content")->default("");
            // 0 => 未知, 1 => 小程序, 2 => App
            $table->unsignedTinyInteger("client")->default(0);
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
        Schema::dropIfExists('order_comments');
    }
};

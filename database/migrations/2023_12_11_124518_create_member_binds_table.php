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
        Schema::create('member_binds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string("app_id")->default("");
            $table->string("open_id")->default("");
            $table->string("union_id")->default("");
            $table->string("session_key");
            $table->string("access_token");
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
        Schema::dropIfExists('member_binds');
    }
};

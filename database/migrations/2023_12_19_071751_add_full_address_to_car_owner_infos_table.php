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
        Schema::table('car_owner_infos', function (Blueprint $table) {
            // 详细地址
            $table->text("full_address")->nullable()->comment("详细地址");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_owner_infos', function (Blueprint $table) {
            $table->dropColumn("full_address");
        });
    }
};

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
            $table->decimal("longitude")->comment("车主信息地址经度");
            $table->decimal("latitude")->comment("车主信息地址纬度");
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
            $table->dropColumn("longitude");
            $table->dropColumn("latitude");
        });
    }
};

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
            $table->bigInteger("user_order_id")->comment("直属订单");
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
            $table->dropColumn("user_order_id");
        });
    }
};

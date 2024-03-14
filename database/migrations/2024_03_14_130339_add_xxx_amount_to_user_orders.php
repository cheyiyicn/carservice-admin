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
        Schema::table('user_orders', function (Blueprint $table) {
            $table->decimal("est_f32_total_price", 10, 2)->comment("总预估服务金额 (float64)");
            $table->unsignedBigInteger("est_u64_total_price")->comment("总预估服务金额 (uint64)");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            $table->dropColumn("est_f32_total_price", "est_u64_total_price");
        });
    }
};

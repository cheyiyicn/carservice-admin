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
        // 依赖 car_owner_infos / car_infos
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("member_id")->comment("关联的用户");
            // ! will be removed.
            // todo: may be use m2m relation. m2m table: `m2m_order_car_owner_infos`
            $table->bigInteger("car_owner_info_id")->comment("关联车主信息");
            $table->bigInteger("car_info_id")->comment("关联车辆信息");
            // ? may be need invoice OR create a new table for creating invoice when the order is finished.
            // $table->bigInteger("invoice_id")->comment("关联发票");
            $table->string("order_number")->unique()->comment("自动生成的唯一订单号");
            $table->decimal("est_amount", 10, 2)->comment("预估金额");
            $table->decimal("act_amount", 10, 2)->comment("实际金额");
            $table->timestamp("expired_at")->nullable()->comment("订单过期时间");
            // 支付相关
            $table->tinyInteger("payment_method")->comment("支付方式: 1.微信, 2.支付宝, 3.银联, 4.TBD...");
            $table->timestamp("paid_at")->nullable()->comment("已经支付的时间");
            $table->tinyInteger("order_status")->default(0)->comment("订单状态");
            // 其他信息相关
            $table->text("comment")->nullable()->comment("其他信息 > 备注");
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
        Schema::dropIfExists('user_orders');
    }
};

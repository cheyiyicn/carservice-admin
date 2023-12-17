<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;
    // |-> 预约 (等待商家浏览订单)
    // |-> 后台检查订单 (补充服务费)
    // |-> 确认订单 (订单价格)
    // |-> 用户 (接受报价)
    // |->|-> 接受: 确认订单 (订单支付倒计时 30 分钟)
    // |->|-> 不接受: ---------------|
    // |->|->|-> 超时订单 -----------|
    // |->|->|-> 取消订单
}

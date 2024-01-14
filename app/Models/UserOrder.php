<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarBrand;
use Illuminate\Database\Eloquent\Relations\{HasOne, BelongsTo};

class UserOrder extends Model
{
    use HasFactory;
    // |- 预约 (等待商家浏览订单)
    // |-- 后台检查订单 (补充服务费)
    // |-- 用户 (接受报价)
    // |---- 接受: 确认订单 (订单支付倒计时 30 分钟)
    // |---- 不接受: -----|
    // |-- 超时订单 ------|
    // |-- 取消订单 ------|
    public function _()
    {
    }

    public function carBrand(): HasOne {
        return $this->hasOne(CarBrand::class, "brand_id", "car_brand_id");
    }

    // FIXME: Should fix relationship.
    public function carSeries(): HasOne {
        return $this->hasOne(CarBrandSeries::class, "series_id", "car_brand_series_id");
    }

    // FIXME: 修复错误的关联
    public function member(): BelongsTo {
        return $this->belongsTo(Member::class, "member_id");
    }

    public function carOwnerInfo(): HasOne {
        return $this->hasOne(CarOwnerInfo::class, 'user_order_id', 'id');
    }
}

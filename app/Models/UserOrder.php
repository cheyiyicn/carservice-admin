<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

interface Description
{
    function desc(): string;
}

// ? 应该抽离到一个文件中
enum OrderStatus: int implements Description
{
    case Pending = 0;               // 等待商家接单
    case ToBeAcceptedByUser = 1;    // 等待用户接受报价
    case ToBePaid = 2;              // 等待付款
    case Cancelled = 3;             // 已取消
    case Refunded = 4;              // 已退款
    case Paid = 5;                  // 已付款
    case ToBeInstalled = 6;         // 待安装
    case InInstallation = 7;        // 安装中
    case Closed = 8;                // 已关闭
    case Completed = 9;             // 已完成

    public function desc(): string
    {
        return match ($this) {
            OrderStatus::Pending => "等待商家接单",
            OrderStatus::ToBeAcceptedByUser => "等待用户接受报价",
            OrderStatus::ToBePaid => "等待用户付款",
            OrderStatus::Cancelled => "用户取消订单",
            OrderStatus::Refunded => "已退款",
            OrderStatus::Paid => "已付款",
            OrderStatus::ToBeInstalled => "待安装",
            OrderStatus::InInstallation => "安装中",
            OrderStatus::Closed => "订单已关闭",
            OrderStatus::Completed => "订单完成"
        };
    }

    public function get($value): string {
        return $this->get($value);
    }
}

enum PaymentMethod: int implements Description
{
    case Alipay = 1;    // 支付宝
    case WeChatPay = 2; // 微信
    case UnionPay = 3;  // 银联

    public function desc(): string
    {
        return match ($this) {
            self::Alipay => "支付宝",
            self::WeChatPay => "微信",
            self::UnionPay => "银联",
        };
    }
}

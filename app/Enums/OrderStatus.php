<?php

namespace App\Enums;

// ? 应该抽离到一个文件中
enum OrderStatus: int implements Description
{
    case Pending = 0;               // 等待商家接单
    case ToBeAcceptedByUser = 1;    // 等待用户接受报价
    case ToBePaid = 2;              // 等待付款
    case Cancelled = 3;             // 已取消
    case Refunded = 4;              // 已退款
    case Paid = 5;                  // 已付款
    case PrepareToInstall = 6;      // 待安装
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
            OrderStatus::PrepareToInstall => "待安装",
            OrderStatus::InInstallation => "安装中",
            OrderStatus::Closed => "订单已关闭",
            OrderStatus::Completed => "订单完成"
        };
    }

    public function get($value): string {
        return $this->get($value);
    }
}

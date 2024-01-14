<?php

namespace App\Enums;

// ? 应该抽离到一个文件中
enum OrderStatus: int implements Description
{
    case Pending = 0;                   // 等待商家接单
    case AwaitingPayment = 1;           // 等待用户付款
    case AwaitingAssignInstaller = 2;   // 等待付款
    case AwaitingInstallation = 3;      // 已取消
    case Completed = 4;                 // 已退款
    case Cancelled = 5;                 // 已付款
    case Refunded = 6;                  // 待安装

    public function desc(): string
    {
        return match ($this) {
            OrderStatus::Pending => "等待商家接单",
            OrderStatus::AwaitingPayment => "等待用户付款",
            OrderStatus::AwaitingAssignInstaller => "等待分配安装人员",
            OrderStatus::AwaitingInstallation => "等待安装",
            OrderStatus::Completed => "已完成",
            OrderStatus::Cancelled => "已取消",
            OrderStatus::Refunded => "已退款",
        };
    }

    public function get($value): string {
        return $this->get($value);
    }
}

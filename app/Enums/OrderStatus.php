<?php

namespace App\Enums;

// ? 应该抽离到一个文件中
enum OrderStatus: int implements Description
{
    case Pending = 0;                   // 等待商家接单
    case AwaitingPayment = 1;           // 等待用户付款
    case AwaitingAssignInstaller = 2;   // 等待分配工作人员
    case AwaitingInstallation = 3;      // 等待安装
    case Completed = 4;                 // 已完成
    case Cancelled = 5;                 // 已取消

    case RequestRefund = 6;             // 发起退款
    case Refunding = 7;                 // 退款中
    case Refunded = 8;                  // 已退款

    public function desc(): string
    {
        // Pending = "等待商家接单", // 1.待处理
        // AwaitingPayment = "等待用户付款", // 1.待处理
        // AwaitingAssignInstaller = "等待分配安装人员", // 2.进行中
        // AwaitingInstallation = "等待安装", // 2.进行中
        // Completed = "已完成", // 3.已完成
        // Cancelled = "已取消", // 3.已完成
        // RequestRefund = "发起退款", // 2.进行中
        // Refunding = "发起退款", // 1.待处理
        // Refunded = "已退款", // 3.已完成
        return match ($this) {
            OrderStatus::Pending => "等待商家接单",
            OrderStatus::AwaitingPayment => "等待用户付款",
            OrderStatus::AwaitingAssignInstaller => "等待分配安装人员",
            OrderStatus::AwaitingInstallation => "等待安装",
            OrderStatus::Completed => "已完成",
            OrderStatus::Cancelled => "已取消",
            
            OrderStatus::RequestRefund => "发起退款",
            OrderStatus::Refunding => "发起退款",
            OrderStatus::Refunded => "已退款",
        };
    }

    public function get($value): string {
        return $this->get($value);
    }
}

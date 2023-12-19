<?php

namespace App\Enums;

enum PaymentMethod: int implements Description
{
    case Unknown = 0;   // 未知
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

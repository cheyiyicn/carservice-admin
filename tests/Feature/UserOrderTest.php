<?php

namespace Tests\Feature;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\{UserOrder};
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserOrderTest extends TestCase
{
    /**
     * 测试用户下单流程
     * 模拟用户下单操作
     *
     * - 车主信息 CarOwnerInfo ✔
     * @deprecated - 车辆信息 CarInfo
     * - 用户需求 UserOrder - comment ✔
     * - 创建订单 UserOrder ✔
     *
     * @return void
     */
    public function test_user_ordering_process()
    {
        // 假设当前用户
        $currentUserId = 1;

        // 创建车主信息 //
        // 判断该用户是否存在其他车主信息
        $infoCount = DB::table('car_owner_infos')->where("user_id", "=", $currentUserId)->count("*");
        // 如果存在则提示仍然创建或者选择已存在的
        $stillCreating = true;
        $lastInsertId = "0";
        if ($infoCount > 0 && $stillCreating) {
            echo "仍然创建\n";
            $status = DB::insert($this->create_car_owner_info_sql(), ['陈某人', $currentUserId, '15718334375', '广东省-东莞市-万江街道', '详细地址']);
            echo "创建车主信息: $status\n";
            $lastInsertId = DB::getPdo()->lastInsertId();
            // 仍然创建
        } else {
            // 创建
            $status = DB::insert($this->create_car_owner_info_sql(), ['陈某人', $currentUserId, '15718334375', '广东省-东莞市-万江街道', '详细地址']);
            echo "创建车主信息: $status\n";
            $lastInsertId = DB::getPdo()->lastInsertId();
        }

        // 创建订单 //
        $carOwnerInfoId = $lastInsertId;
        $userId = $currentUserId;
        // 假设的品牌
        $carBrandId = 2;
        // 假设的品牌系列
        $carBrandSeriesId = 72;
        // 准备订单号
        $orderNumber = "2023-12-19T02:43:37.857933+00:00";
        // 初始订单状态
        $orderStatus = OrderStatus::Pending->value;
        // 需求留言
        $requirements = "安装赛车尾翼";
        // 默认支付方式
        $paymentMethod = PaymentMethod::Unknown->value;
        // 创建
        $query = $this->create_user_order_sql();
        $status = DB::insert($query, [$userId, $carBrandId, $carBrandSeriesId, $carOwnerInfoId, 0, $orderNumber, $orderStatus, $requirements, 0.00, 0.00, $paymentMethod]);
        echo "创建订单: $status\n";
    }

    private function create_user_order_sql(): string {
        return "INSERT INTO `user_orders`(`member_id`, `car_brand_id`, `car_brand_series_id`, `car_owner_info_id`, `car_info_id`, `order_number`, `order_status`, `comment`, `est_amount`, `act_amount`, `payment_method`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }

    private function create_car_owner_info_sql(): string {
        return $status = "INSERT INTO `car_owner_infos`(`name`, `user_id`, `phone_number`, `multilevel_address`, `full_address`) VALUES(?, ?, ?, ?, ?)";
    }
}

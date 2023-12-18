<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserOrderTest extends TestCase
{
    /**
     * todo: 测试用户下单流程
     * todo: 模拟用户下单操作
     * todo: - 车主信息 CarOwnerInfo
     * todo: - 车辆信息 CarInfo
     * todo: - 用户需求 UserOrder - comment
     * todo: - 创建订单 UserOrder
     *
     * @return void
     */
    public function test_user_ordering_process()
    {
        $response = $this->get('/');
        // todo: do something here
        $response->assertStatus(200);
    }
}

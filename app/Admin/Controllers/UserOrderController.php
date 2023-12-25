<?php

namespace App\Admin\Controllers;

use App\Models\{UserOrder, OrderStatus};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserOrder';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserOrder());

        $grid->column('id', __('ID'));
        $grid->column('member_id', __('用户名'));
        // show car brand.
        $grid->column("car_brand_id");
        // show series of car brand.
        $grid->column("car_brand__series_id");
        // 展示用户手机号
        // $grid->column("")
        $grid->column('car_owner_info_id', __('车主信息'));
        $grid->column('order_number', __('订单号'));
        // $grid->column('est_amount', __('预估金额'));
        $grid->column('act_amount', __('服务金额'));
        // $grid->column('expired_at', __('Expired at'));
        // $grid->column('payment_method', __('Pay method'));
        // $grid->column('paid_at', __('Paid at'));
        $grid->column('order_status', __('订单状态'))->display(function ($value) {
            if ($this->deleted_at) return "<b style='color: red'>已删除</b>";
            if ($value == OrderStatus::Pending->value) return "等待接单";
            return OrderStatus::tryFrom($value)->desc();
        });
        // $grid->column('comment', __('Comment'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(UserOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('car_owner_info_id', __('Car owner info id'));
        $show->field('car_info', __('Car info'));
        $show->field('order_number', __('Order number'));
        $show->field('est_amount', __('Est amount'));
        $show->field('act_amount', __('Act amount'));
        $show->field('expired_at', __('Expired at'));
        $show->field('pay_method', __('Pay method'));
        $show->field('paid_at', __('Paid at'));
        $show->field('order_status', __('Order status'));
        $show->field('comment', __('Comment'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserOrder());

        // $form->number('member_id', __('Member id'));
        $form->number('car_owner_info_id', __('Car owner info id'));
        $form->number('car_info', __('Car info'));
        $form->text('order_number', __('Order number'));
        $form->decimal('est_amount', __('Est amount'));
        $form->decimal('act_amount', __('Act amount'));
        $form->datetime('expired_at', __('Expired at'))->default(date('Y-m-d H:i:s'));
        $form->switch('pay_method', __('Pay method'));
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->switch('order_status', __('Order status'));
        $form->textarea('comment', __('Comment'));

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Models\{UserOrder};
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Enums\{OrderStatus};
use Encore\Admin\Grid\Displayers\Actions;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\{
    Table as WidgetsTable,
    Form as WidgetsForm,
};
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $grid->disableCreateButton();
        $grid->actions(function (Actions $actions) {
            $actions->disableView();
        });
        $grid->column('id', __('ID'));
        $grid->column('order_number', __('订单号'));
        $grid->column('member.username', __('用户名'))->display(function ($value) {
            return $value;
        });
        // show series of car brand.
        $grid->column("carSeries.series_name", "用户车辆");
        $grid->column('act_amount', __('服务金额'))->color("#008000")->decimal();
        $grid->column('order_status', __('订单状态'))->display(function ($value) {
            if ($this->deleted_at) return "<b style='color: red'>已删除</b>";
            if ($value == OrderStatus::Pending->value) return "等待接单";
            return OrderStatus::tryFrom($value)->desc();
        });
        $grid->column('partner_store_id', "门店");
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
    // protected function form()
    // {
    //     $form = new Form(new UserOrder());
    //     if ($form->isEditing())
    //     $form->text("member.username", "用户名")->readonly();
    //     $form->text("member.carSeries.series_name", "用户车辆")->readonly();
    //     $form->number('car_info', __('Car info'));
    //     $form->text('order_number', __('Order number'));
    //     $form->decimal('est_amount', __('Est amount'));
    //     $form->decimal('act_amount', __('Act amount'));
    //     $form->datetime('expired_at', __('Expired at'))->default(date('Y-m-d H:i:s'));
    //     $form->switch('pay_method', __('Pay method'));
    //     $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
    //     $form->switch('order_status', __('Order status'));
    //     $form->textarea('comment', __('Comment'));
    //     $form->saving(function (Form $form) {
    //         if ($form->_method == "PUT" && $form->act_amount) {
    //             $this->onChangeActAmount($form->model());
    //         }
    //     });
        

    //     return $form;
    // }

    private function onChangeActAmount(Model $model)
    {
        // ==== 更改状态 ==== //
        // 1.若状态是 `待商家确认` !(待用户付款代表已经确认价格)
        if ($model->order_status == OrderStatus::Pending->value) {
            $model->order_status = OrderStatus::AwaitingPayment->value;
            $model->save();
        }
    }

    public function edit($id, Content $content)
    {
        $order = UserOrder::find($id);
        $orderStatus = OrderStatus::tryFrom($order->order_status)->desc();
        $carBrand = $order->carBrand->toArray();
        $carSeries = $order->carSeries->toArray();
        $carOwnerInfo = $order->carOwnerInfo->toArray();
        $partnerStores = $this->getPartnerStores($carOwnerInfo['multilevel_address'] . $carOwnerInfo['full_address'], 15);
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->view("admin.user-orders.edit", [
                'order' => $order->toArray(),
                'orderStatus' => $orderStatus,
                'installable' => $order->order_status == OrderStatus::AwaitingInstallation,
                'carBrand' => $carBrand,
                'carSeries' => $carSeries,
                'carOwnerInfo' => $carOwnerInfo,
                'partnerStores' => $partnerStores,
            ]);
    }

    public function update($id)
    {
    }

    private function getPartnerStores($address, $gap) {
        $url = "https://restapi.amap.com/v3/geocode/geo?key=%s&address=%s";
        $realUrl = sprintf($url, env("AMAP_KEY"), $address);
        $response = Http::get($realUrl);
        $responseData = [];
        if ($response->ok()) {
            $data = $response->json();
            $lng = 0.00;
            $lat = 0.00;
            if ($data['count'] >= 1) {
                $location = explode(',', $data['geocodes'][0]['location']);
                $query = "SELECT `id`, `title`, (ST_DISTANCE_SPHERE(POINT(?, ?), POINT(longitude, latitude))) / 1000 AS `distance` FROM `partner_stores` WHERE `status` = 1 HAVING `distance` <= ?";
                $result = DB::select($query, [$location[0], $location[1], 15]);
                $responseData = $result;
            }
        }
        return $responseData;
    }
}

class ShowCarOwnerInfo implements Renderable
{
    public function render($key = null)
    {
        print "1";
    }
}

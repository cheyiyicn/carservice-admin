<?php

namespace App\Admin\Controllers;

use App\Models\PartnerStore;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PartnerStoreController extends AdminController
{
    // 首次加载该模块时加载服务
    public function __construct()
    {
        // $c = config("map.jsapi_key");
        // dd($c);
        $this->loadAMapSecurityConfig();        
    }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '合作门店';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PartnerStore());

        $grid->column('id', __('ID'));
        $grid->column('title', __('门店名称'));
        // $grid->column('short_title', __('门店短名称'));
        // $grid->column('english_title', __('English title'));
        // $grid->column('store_number', __('门店编号'));
        // $grid->column('address', __('地址'));
        $grid->column('full_address', __('完整地址'));
        $grid->column('phone_number', __('负责人手机号'));
        // $grid->column('longitude', __('Longitude'));
        // $grid->column('latitude', __('Latitude'));
        // $grid->column('description', __('Description'));
        // $grid->column('html_description', __('Html description'));
        $grid->column('status', __('状态'))->switch();
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
        $show = new Show(PartnerStore::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('门店名称'));
        $show->field('short_title', __('门店短名称'));
        $show->field('english_title', __('门店英文名称'));
        $show->field('store_number', __('门店编号'));
        $show->field('address', __('地址'));
        $show->field('full_address', __('完整地址'));
        $show->field('phone_number', __('负责人手机号'));
        $show->field('longitude', __('经度'));
        $show->field('latitude', __('纬度'));
        $show->field('description', __('门店描述信息'));
        $show->field('html_description', __('Html 门店描述信息'));
        $show->field('status', __('状态'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // AMap security config fn.
        // if change the proxy url, please go to `public/js/amap/proxy.js`.
        $form = new Form(new PartnerStore());

        $form->text('title', __('门店名称'))->required();
        $form->text('short_title', __('门店短名称'))->default("TBD");
        $form->text('english_title', __('门店英文名称'))->default("TBD");
        $form->text('store_number', __('门店编号'))->default("TBD");

        // $form->latlong('latitude', 'longitude', 'Position', "选择位置")->default(['lat' => 90, 'lng' => 90])->height(600)->zoom(12);
        $form->text('address', __('地址'))->disable();
        $form->text('full_address', __('完整地址'))->help("选择地址自动填充");
        $form->amap('latitude', "longitude", __("地图"));

        $form->text('phone_number', __('负责人手机号'))->required();
        // $form->decimal('longitude', __('Longitude'));
        // $form->decimal('latitude', __('Latitude'));
        $form->text('description', __('门店描述信息'))->default("TBD");
        $form->textarea('html_description', __('Html 门店描述信息'))->default("TBD");
        $form->switch('status', __('状态'))->default(1);

        $form->submitted(function (Form $form) {
            $form->address = "TBD";
        });

        return $form;
    }

    private function loadAMapSecurityConfig() {
        Admin::headerJs("js/amap/proxy.js");
    }
}

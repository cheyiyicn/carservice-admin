<?php

namespace App\Admin\Controllers;

use App\Models\PartnerStore;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Latlong\Extension;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;

class PartnerStoreController extends AdminController
{
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
        $grid->column('store_number', __('门店编号'));
        $grid->column('address', __('地址'));
        $grid->column('full_address', __('完整地址'));
        $grid->column('phone_number', __('负责人手机号'));
        // $grid->column('longitude', __('Longitude'));
        // $grid->column('latitude', __('Latitude'));
        // $grid->column('description', __('Description'));
        // $grid->column('html_description', __('Html description'));
        $grid->column('status', __('状态'));
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
        $form = new Form(new PartnerStore());

        $form->text('title', __('门店名称'));
        $form->text('short_title', __('门店短名称'));
        $form->text('english_title', __('门店英文名称'));
        $form->text('store_number', __('门店编号'));

        // $form->latlong('latitude', 'longitude', 'Position', "选择位置")->default(['lat' => 90, 'lng' => 90])->height(600)->zoom(12);
        $form->text('address', __('地址'));
        $form->text('full_address', __('完整地址'));
        $form->amap('latitude', "longitude", __("地图"));

        $form->text('phone_number', __('负责人手机号'));
        // $form->decimal('longitude', __('Longitude'));
        // $form->decimal('latitude', __('Latitude'));
        $form->text('description', __('门店描述信息'));
        $form->textarea('html_description', __('Html 门店描述信息'));
        $form->switch('status', __('状态'));

        return $form;
    }
}
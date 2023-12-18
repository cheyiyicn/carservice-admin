<?php

namespace App\Admin\Controllers;

use App\Models\CarBrand;
use App\Models\CarBrandSeries;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Form\Field\Decimal;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Tools\QuickCreate;
use Encore\Admin\Show;

class CarBrandSeriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '汽车系列';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CarBrandSeries());

        $grid->filter(function (Filter $filter) {
            // disable default filter.
            $filter->disableIdFilter();
            $filter->equal('brand_id', __('汽车品牌'))->select(CarBrand::all()->pluck("brand_name", "brand_id"));
        });

        // $grid->quickCreate(function (QuickCreate $c) {
        //     $c->select('brand_id', __('直属品牌'))
        //         ->options(CarBrand::all()->pluck('brand_name', 'id'))
        //         ->required();
        //     $c->text('title', __('名称'))->required();
        //     $c->text('english_title', __('英文名称'))->default("TBD");
        //     $c->text('dealer_price', __('经销商售价'))->default("TBD - TBD 万");
        //     $c->text('official_price', __('官方售价'))->default("TBD - TBD 万");
        // });

        $grid->column('series_id', __('ID'));
        $grid->column('brand.brand_name', __('直属品牌'));
        $grid->column('series_name', __('车系名称'))->display(function ($value) {
            return $value;
        });
        $grid->column('sub_brand_name', __('全称'));
        $grid->column('image_url', __('图片'))->display(function () {
            return "<span style='color: orange'>TODO</span>";
        });
        $grid->column('dealer_price', __('经销商售价'));
        $grid->column('official_price', __('官方售价'));
        $grid->column('created_at', __('创建时间'))->datetime();
        $grid->column('updated_at', __('更新时间'))->datetime();

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
        $show = new Show(CarBrandSeries::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('car_brand_id', __('Car brand id'));
        $show->field('title', __('Title'));
        $show->field('english_title', __('English title'));
        $show->field('dealer_price', __('Dealer price'));
        $show->field('offical_price', __('Offical price'));
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
        $form = new Form(new CarBrandSeries());

        $form->select('brand_id', __('直属品牌'))
            ->options(CarBrand::all()
            ->pluck('brand_name', 'brand_id'))
            ->required();
        $form->text('series_name', __('名称'))->required();
        $form->text("sub_brand_name", __('子品牌名称'))->required();
        $form->text("image_url", __('图片'))->default("TBD");
        // 官方售价
        $form->decimal("official_price_up", __("官方最高售价(万)"))->default(0.00);
        $form->decimal("official_price_down", __("官方最低售价(万)"))->default(0.00);
        $form->text("official_price", __("官方售价区间"))->default("TBD");
        // 经销商售价
        $form->decimal("dealer_price_up", __("经销商最高售价(万)"))->default(0.00);
        $form->decimal("dealer_price_down", __("经销商最低售价(万)"))->default(0.00);
        $form->text("dealer_price", __("经销商售价区间"))->default("TBD");
        $form->text("category_name", __("汽车类型"))->default("TBD");

        $form->switch("business_status", __("是否正在营业"))->default(1);

        return $form;
    }
}

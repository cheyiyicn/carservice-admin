<?php

namespace App\Admin\Controllers;

use App\Models\CarBrand;
use App\Models\CarBrandSeries;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
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

        $grid->quickCreate(function (QuickCreate $c) {
            $c->select('car_brand_id', __('直属品牌'))
                ->options(CarBrand::all()->pluck('title', 'id'))
                ->required();
            $c->text('title', __('名称'))->required();
            $c->text('english_title', __('英文名称'))->default("TBD");
            $c->text('dealer_price', __('经销商售价'))->default("TBD - TBD 万");
            $c->text('offical_price', __('官方售价'))->default("TBD - TBD 万");
        });

        $grid->column('id', __('ID'));
        $grid->column('brand.title', __('直属品牌'));
        $grid->column('title', __('车系名称'))->display(function ($value) {
            return $value;
        });
        // $grid->column('english_title', __('英文名称'));
        $grid->column('dealer_price', __('经销商售价'));
        $grid->column('offical_price', __('官方售价'));
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

        $form->select('car_brand_id', __('直属品牌'))
            ->options(CarBrand::all()->pluck('title', 'id'))
            ->required();
        $form->text('title', __('名称'))->required();
        $form->text('english_title', __('英文名称'))->default("TBD");
        $form->text('dealer_price', __('经销商售价'))->default("TBD - TBD 万");
        $form->text('offical_price', __('官方售价'))->default("TBD - TBD 万");

        return $form;
    }
}

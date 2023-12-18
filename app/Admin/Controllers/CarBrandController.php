<?php

namespace App\Admin\Controllers;

use App\Models\CarBrand;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools\QuickCreate;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class CarBrandController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '汽车品牌管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CarBrand());
        // Quick create
        // $grid->quickCreate(function (QuickCreate $create) {
        //     $create->text('brand_name', __('名称'));
        //     $create->text('brand_english_name', __('英文名称'))->default("TBD");
        // });
        // Columns
        $grid->column('brand_id', __('ID'));
        $grid->column("image_url", __('品牌标志'))->display(function () {
            return "<span style='color: orange'>TODO</span>";
        });
        $grid->column('brand_name', __('品牌名称'))->modal("品牌系列", function (CarBrand $model) {
            // $series = $model->brandSeries()->take(10)->get()->map(function ($comment) {
            //     return $comment->only(['id', 'title']);
            // });
            // return new Table(['ID', '车系名称'], $series->toArray());
        });
        $grid->column("brand_english_name", __('英文名称'));
        $grid->column("brand_type", __('车系'));
        $grid->column("brand_country", __('国家'));
        // $grid->column("content_abstract", __('描述'));
        $grid->column("business_status", __('是否在营业'));
        $grid->column('created_at', __('创建时间'))->date("Y-m-d");
        $grid->column('updated_at', __('更新时间'))->date("Y-m-d");

        return $grid;
    }

    /**
     * Make a show builder.
     * todo: _
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(CarBrand::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('car_company_id', __('汽车品牌'))->default(0);
        $show->field('title', __('Title'));
        $show->field('english_title', __('English title'));
        $show->field('short_title', __('Short title'));
        $show->field('type', __('Type'));
        $show->field('description', __('Description'));
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
        $form = new Form(new CarBrand());

        $form->text('brand_name', __('品牌名称'))->required();
        $form->text('pinyin', __('中文首字母'))->help("如 \"大众\" 填 \"D\"")->required();
        $form->text('brand_english_name', __('品牌英文名称'))->default("TBD");
        $form->text("image_url", __('品牌标志'))
            ->help("<span style='color: orange'>TODO</span>")
            ->default("");
        $form->text("brand_type", __("车系"))->default("TBD");
        $form->text("brand_country", __("国家"))->default("TBD");
        $form->textarea("content_abstract", __("品牌描述"))->default("TBD");
        $form->switch("business_status", __('是否正在营业'))->default(1);

        return $form;
    }
}

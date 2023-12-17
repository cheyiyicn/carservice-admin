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
        $grid->quickCreate(function (QuickCreate $create) {
            $create->text('title', __('名称'));
            $create->text('english_title', __('英文名称'))->default("TBD");
            $create->text('short_title', __('短称'))->default("TBD");
        });
        $grid->column('id', __('ID'));
        $grid->column('title', __('名称'))->modal("车系", function (CarBrand $model) {
            $series = $model->brandSeries()->take(10)->get()->map(function ($comment) {
                return $comment->only(['id', 'title']);
            });
            return new Table(['ID', '车系名称'], $series->toArray());
        });
        $grid->column('english_title', __('英文名称'));
        $grid->column('short_title', __('短称'));
        // $grid->column('type', __('类型'));
        // $grid->column('description', __('描述'));
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

        $form->text('car_company_id', __('汽车品牌'))->default(0)->disable();
        $form->text('title', __('名称'))->required();
        $form->text('english_title', __('英文名称'))->default("TBD");
        $form->text('short_title', __('短名称'))->default("TBD");
        $form->text('type', __('Type'))->default("TBD");
        $form->textarea('description', __('品牌描述'))->default("TBD");

        return $form;
    }
}

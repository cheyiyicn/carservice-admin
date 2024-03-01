<?php

namespace App\Admin\Controllers;

use App\Models\CarReplacement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Tree;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;

class CarReplacementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '汽车配件管理';

    public function index(Content $content) {
        return $content
            ->title("汽车配件列表")
            ->description(trans('admin.list'))
            ->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());
                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('car-replacements'));

                    $form->select("parent_id", "父级选项")->options(CarReplacement::selectOptions());
                    $form->text('title', "名称")->rules('required');
                    
                    $form->divider('服务费');
                    $form->decimal("lm_est_f32_price", __("低端车型服务价"))->default(0.00)->rules("required")->help("单位: 元");
                    $form->hidden("lm_est_u64_price");
                    $form->decimal("hm_est_f32_price", __("高端车型服务价"))->default(0.00)->rules("required")->help("单位: 元");
                    $form->hidden("hm_est_u64_price");
                    // $form->hidden("counter");
                    $form->hidden('_token')->default(csrf_token());
                    // $form->saved(function (Form $form) {
                    //     $form->est_u64_price = $form->est_u64_price * 100;
                    //     $form->counter = 0;
                    // });
                    $column->append((new Box(trans('admin.new'), $form))->style('success'));
                });
            });
    }

    protected function treeView() {
        $tree = new Tree(new CarReplacement);
        $tree->disableCreate();
        return $tree;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CarReplacement());

        $grid->column('id', __('ID'));
        $grid->column('parent_id', __('父级 ID'));
        $grid->column('title', __('配件名称'));
        $grid->column('est_f32_price', __('预估安装价格 1'));
        $grid->column('est_u64_price', __('预估安装价格 2'));
        $grid->column('counter', __('层级计数'));
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
        $show = new Show(CarReplacement::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('title', __('Title'));
        $show->field('est_f32_price', __('预估安装价格 1'));
        $show->field('est_u64_price', __('预估安装价格 2'));
        $show->field('counter', __('Counter'));
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
        $form = new Form(new CarReplacement());

        $form->select('parent_id', __('父级配件'))->options(CarReplacement::selectOptions());
        $form->text('title', __('名称'));
        
        $form->divider('服务费');
        $form->decimal("lm_est_f32_price", __("低端车型服务价"))->help("单位: 元");
        $form->hidden("lm_est_u64_price");
        $form->decimal("hm_est_f32_price", __("高端车型服务价"))->help("单位: 元");
        $form->hidden("hm_est_u64_price");
        // $form->hidden("counter");

        $form->saving(function (Form $form) {
            // if ($form->isEditing()) {
            //     // check counter of parent element.
            //     if ($form->parent_id === 0) {
            //         $form->counter = 1;
            //     } else {
            //         $p = CarReplacement::where("id", $form->parent_id)->first();
            //         $form->counter = $p->counter + 1;
            //     }
            // }
            
            $form->est_u64_price = $form->est_f32_price * 100;
            $form->lm_est_u64_price = $form->lm_est_f32_price * 100;
            $form->hm_est_u64_price = $form->hm_est_f32_price * 100;
        });

        return $form;
    }

    protected function getReplacementTree() {

    }
}

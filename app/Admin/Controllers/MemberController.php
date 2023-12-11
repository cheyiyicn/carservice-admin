<?php

namespace App\Admin\Controllers;

use App\Models\Member;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Member';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Member());

        $grid->column("id", "ID");
        $grid->column("username", "用户名");
        $grid->column("avatar_url", "头像");
        $grid->column("phone_number", "手机号");
        $grid->column("locked", "是否锁定?");
        $grid->column("created_at", "创建时间");
        $grid->column("updated_at", "更新时间");

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
        $show = new Show(Member::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Member());

        $form->text("username", "用户名");
        $form->text("phone_number", "手机号");
        $form->switch("locked", "是否锁定?")->states([
            "on" => ["value" => 1, "text" => "锁定", "color" => "danger"],
            "off" => ["value" => 0, "text" => "解锁", "color" => "success"],
        ]);
        $form->password("password", "密码")->default("123456");

        return $form;
    }
}

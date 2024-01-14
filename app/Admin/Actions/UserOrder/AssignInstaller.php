<?php

namespace App\Admin\Actions\UserOrder;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class AssignInstaller extends Action
{
    public function __construct()
    {
        parent::__construct();
    }
    public $name = "分配安装人员";
    protected $selector = '.assign-installer';

    public function handle(Request $request)
    {
        // $request ...

        return $this->response()->success('Success message...')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default assign-installer">???</a>
HTML;
    }
}
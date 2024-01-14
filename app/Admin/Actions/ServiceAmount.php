<?php

namespace App\Admin\Actions;

use Encore\Admin\Admin;

class ServiceAmount
{
    public function __construct(protected $id)
    {
        $this->id = $id;
    }

    protected function script() {
        return <<<SCRIPT
        //
        SCRIPT;
    }

    protected function render() {
        Admin::script($this->script());
        return "<input name='act_amount' />";
    }

    public function __toString()
    {
        return $this->render();
    }
}
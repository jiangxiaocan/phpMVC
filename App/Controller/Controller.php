<?php
namespace jxc\App\Controller;
use Jxc\Frame\View;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 13:49
 */
class Controller
{
    protected $view;

    protected function before()
    {
        $this->view = View::getInstance();
    }
}
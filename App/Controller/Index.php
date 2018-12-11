<?php
namespace Jxc\App\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/10
 * Time: 14:02
 */
class Index extends Controller {
    public function index()
    {
        parent::before();
        $this->view->assign('test',123);
        $this->view->render('index');
    }

    public function dd()
    {
        echo 'dd';
    }
}
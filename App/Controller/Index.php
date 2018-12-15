<?php
namespace Jxc\App\Controller;
use Jxc\App\Model\IndexModel;

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
        $testModel = IndexModel::getInstance();
        $data = $testModel->getInfo();
        $this->view->assign('data',$data);
        $this->view->render('index');
    }


}
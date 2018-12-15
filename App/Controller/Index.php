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

    public function add()
    {
        $testModel = IndexModel::getInstance();
        $data = array('test1','test2','test3',time());
        $testModel->addInfo($data);
        echo '写入成功！';
    }

    public function update()
    {
        $testModel = IndexModel::getInstance();
        $testModel->updateInfo(1);
        echo '修改成功！';
    }

    public function delete()
    {
        $testModel = IndexModel::getInstance();
        $testModel->delInfo('7');
        echo '删除成功！';
    }

    public function look()
    {
        $testModel = IndexModel::getInstance();
        $data = $testModel->getInfo();
        print_r($data);
    }

}
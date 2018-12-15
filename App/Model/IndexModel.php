<?php

namespace Jxc\App\Model;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14
 * Time: 15:22
 */

class IndexModel extends BaseModel
{

    protected function __construct()
    {
        $this->table = 'test';
        $this->dbGroup = 'admin';
    }

    public function getInfo()
    {

        $sql =' SELECT * FROM '.$this->table.' where 1=1 ';
        $data = $this->read($sql,array());
        return $data;
    }
}
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
        $this->table = 'zigbee';
        $this->dbGroup = 'admin';
    }

    /**
     *  查询数据
     * @return array|mixed
     */
    public function getInfo()
    {

        $sql =' SELECT * FROM '.$this->table.' where 1=1 ';
        $data = $this->read($sql,array());
        return $data;
    }

    /**
     * 增加数据
     * @param $data
     */
    public function addInfo($data)
    {
        $sql =' insert into '.$this->table.' set `nodeid`=? , `temp`=? , `humi`=? , `time`=? ';
        $bool = $this->write($sql,$data);
        return $bool;
    }
    
    /*
     * 修改数据
     */
    public function updateInfo($id)
    {
        $sql = ' UPDATE '.$this->table.' SET time=? WHERE id=?';
        $data = array(time(),$id);
        $bool = $this->write($sql,$data);
        return $bool;
    }
    
    /**
     *  删除数据
     */
    public function delInfo($id)
    {
        $sql = ' DELETE FROM '.$this->table.' WHERE id=? ';
        $data = array($id);
        $bool = $this->write($sql,$data);
        return $bool;
    }
}
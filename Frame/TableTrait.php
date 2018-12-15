<?php
namespace Jxc\Frame;


trait TableTrait
{
    private $_dbInstances;
    private $_mysqlInstances;
    protected $dbGroup = '';
    protected $primaryKey = 'id';
    protected $isAutoIncr = true;
    protected $table = '';
    protected $conConfigArray;

    /**
     * @param string $dbGroup
     * @return Mysql
     */
    public function db($dbGroup = '',$isMaster = true, $config = array())
    {
        $configTwoArray = include CONFIG_PATH.'Db.php';
        $configArray = $configTwoArray['master'];
        if(!$isMaster){
            $configArray = $configTwoArray['slave_list'][array_rand($configTwoArray['slave_list'])];
        }
        $configArray += $config;
        $this->conConfigArray = $configArray;
        if (!$dbGroup) {
            $dbGroup = $this->dbGroup;
        }
        if (empty($this->_dbInstances[$dbGroup])) {
            list($this->_dbInstances[$dbGroup],$this->_mysqlInstances[$dbGroup] )= Mysql::getInstance($configArray);
        }
        return $this->_dbInstances[$dbGroup];
    }

    public function getTable()
    {
        return $this->table;
    }

    public function closeDBConnect()
    {

        $this->_mysqlInstances[$this->dbGroup]->closeConnect($this->conConfigArray);
        unset($this->_mysqlInstances[$this->dbGroup]);
        unset($this->_dbInstances[$this->dbGroup]);
    }


}
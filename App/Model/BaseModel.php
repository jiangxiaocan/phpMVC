<?php
namespace Jxc\App\Model;
/**
 * 数据库基础操作方法都在类上面
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14
 * Time: 17:11
 */


use Jxc\Frame\TableTrait;

class BaseModel extends Model
{
    protected $dbGroup;
    protected $table;
    protected $exception;
    protected $lastErrorCode;
    protected $inTransaction = false;
    protected $dbConfigArray = array();
    use TableTrait;
    /**
     * 执行查询操作
     * @param string $sql
     * @param array $data
     * @param bool $isMaster
     * @return array|mixed
     */
    public function read($sql, $data, $isMaster = false)
    {

        try {
            $result = $this->db($this->dbGroup,$isMaster,$this->dbConfigArray)->prepare($sql);
            $result->execute($data);
            $result->setFetchMode(\PDO::FETCH_ASSOC);
            $result = $result->fetchAll();
        } catch (\PDOException $ex) {
            $this->lastErrorCode = $ex->errorInfo[1];
            $this->exception = $ex;
            $this->doException($sql.'---'.$ex->getMessage());
            // 如果是超时重连的异常，则执行如下的操作
            if (in_array($this->lastErrorCode, [1317, 2006, 2013])) {

            }
        } catch (\Exception $e){

        }
        return $result;
    }

    /**
     * 执行写入操作
     * @param string $sql
     * @param $data
     * @return bool|int
     */
    public function write($sql, $data, $isMaster = true)
    {
        try {
            $result = $this->db($this->dbGroup,$isMaster,$this->dbConfigArray)->prepare($sql);
            $result->execute($data);
            $result = $result->rowCount();
        } catch (\PDOException $ex) {
            $this->exception = $ex;
            $this->lastErrorCode = $ex->errorInfo[1];
            $this->doException($sql.'---'.$ex->getMessage());
            $result = false;
        } catch (\Exception $e){

        }
        return $result;
    }


    public function startTransaction()
    {
        $this->dbConfigArray['auotocommit'] = false;
        $result = $this->db($this->dbGroup,true,$this->dbConfigArray)->beginTransaction();
        if($result){
            $this->inTransaction = true;
        }

    }

    public function commitTransaction()
    {
        $result = $this->db($this->dbGroup,true,$this->dbConfigArray)->commit();
        if($result){
            $this->inTransaction = false;
        }

    }

    public function rollbackTransaction()
    {
        $result = $this->db($this->dbGroup,true,$this->dbConfigArray)->rollBack();
        if($result){
            $this->inTransaction = false;
        }
    }
    /**
     *  获取一行的数据
     * @param $sql
     * @param $data
     * @return mixed|null
     */
    public function fetchRow($sql,$data)
    {
        $reslut = $this->read($sql,$data);
        return empty($reslut)?null:current($reslut);
    }

    /**
     *  获取多条数据
     * @param $sql
     * @param $data
     * @return array|mixed|null
     */
    public function fetchArray($sql,$data)
    {
        $reslut = $this->read($sql,$data);
        return empty($reslut)?null:$reslut;
    }

    /**
     * 增加一条数据
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $sql = "";
        $valArray = [];
        foreach ($data as $key=>$val)
        {
            $val = $this->escape($val);
            $sql .= "`{$key}`=?,";
            $valArray[] = $val;
        }
        $sql = substr($sql, 0, -1);
        $sql = "insert into `{$this->table}` set {$sql}";
        $this->write($sql,$valArray);
        return $this->getLastInsertId();

    }

    /**
     * 获取异常
     * @return mixed|\Exception
     */
    public function getLastException()
    {
        return $this->exception;
    }


    /**
     * 获取自增ID
     * @return string
     */
    public function getLastInsertId()
    {
        return $this->db($this->dbGroup,true)->lastInsertId();
    }


    /**
     *  处理pod异常事件
     */
    public function doException($message)
    {
        print_r($message);
    }

    /**
     * 关闭pdo的连接
     */
    public function closeConnect()
    {
        $this->closeDBConnect();
    }
}
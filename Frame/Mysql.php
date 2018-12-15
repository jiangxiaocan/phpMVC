<?php
namespace Jxc\Frame;

/**
 * Class Mysql
 * 只支持1主N从，读（从）写（主）分离，事务需要在主库上执行
 *
 * @package Mt\Db
 */
class Mysql
{
    const CONNECTION_TIMEOUT = 15; // 每个连接只能使用15s，超过这个时间之后创建新连接
    protected $exception;
    private static $instances = [];
    protected static $db;
    private static $instancesDb = [];


    public function __construct($config)
    {
        self::$db =  $this->connect($config);
    }

    /**
     * @param array $config
     * @param bool $useBackup
     * @return Mysql
     */
    public static function getInstance($config)
    {
        $key = md5(get_called_class() . ':' . serialize($config));
        if (!isset(self::$instancesDb[$key])) {
            self::$instances[$key] = new static($config);
            self::$instancesDb[$key] = self::$db;
        }
        return array(self::$instancesDb[$key],self::$instances[$key]);
    }


    /**
     * 连接数据库
     * @param $cfg
     * @return \PDO
     * @throws \Exception
     */
    protected function connect($cfg)
    {
        $opts = array(
            \PDO::ATTR_AUTOCOMMIT => isset($cfg['auotocommit'])?true:false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_TIMEOUT => $cfg['timeout']?$cfg['timeout']:self::$cfg['timeout'],
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '" . $cfg['charset'] . "'",
        );
        $dsn = 'mysql:dbname=' . $cfg['dbname'] . ';host=' . $cfg['host'] . ';port=' . $cfg['port'];
        try {

            $db = new \PDO($dsn, $cfg['username'], $cfg['password'], $opts);

        } catch (\PDOException $ex) {
            $this->exception = $ex;
            $message = "MySQL connection failed [" . $dsn . ';' . $cfg['username'] . ';password]' . $ex->getCode() . '=>' . $ex->getMessage();
            throw new \PDOException($message, 90201);
        }
        return $db;
    }

    /**
     * 关闭数据的连接
     */
    public static function closeConnect($config)
    {
        $key = md5(get_called_class() . ':' . serialize($config));
        unset(self::$instances[$key]);
        unset(self::$instancesDb[$key]);
        return true;
    }
}
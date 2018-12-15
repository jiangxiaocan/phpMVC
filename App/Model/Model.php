<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 14:16
 */
namespace Jxc\App\Model;
use Jxc\Frame\InstanceTrait;

abstract class Model{
    use InstanceTrait {
        __construct as protected;
    }

    function escape($str)
    {
        if (is_string($str))
        {
            $str = $this->escape_str($str);
        }
        elseif (is_bool($str))
        {
            $str = ($str === FALSE) ? 0 : 1;
        }
        elseif (is_null($str))
        {
            $str = 'NULL';
        }

        return $str;
    }

    function escape_str($str, $like = FALSE)
    {
        if (is_array($str))
        {
            foreach ($str as $key => $val)
            {
                $str[$key] = $this->escape_str($val, $like);
            }

            return $str;
        }

        $str = addslashes($str);

        if ($like === TRUE)
        {
            $str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
        }

        return $str;
    }
}
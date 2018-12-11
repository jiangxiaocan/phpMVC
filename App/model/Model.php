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
}
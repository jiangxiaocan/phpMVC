<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/14
 * Time: 15:27
 */
return [
    'master' => array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'username' => 'root',
        'password' => 'password',
        'dbname' => 'index',
        'charset' => 'utf8',
        'timeout' => 3,
    ),
    'slave_list' => array(
        array(
            'host' => '127.0.0.1',
            'port' => '3306',
            'username' => 'root',
            'password' => 'password',
            'dbname' => 'index',
            'charset' => 'utf8',
            'timeout' => 3,
        ),
    )

];
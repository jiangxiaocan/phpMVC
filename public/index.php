<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/10
 * Time: 9:40
 */// 定义根目录路径
define('ROOT_PATH', __DIR__ .'/../');
define('APP_PATH', ROOT_PATH .'/app/');
// 定义框架目录路径
define('FRAME_PATH', ROOT_PATH . 'frame/');
// 调用框架入口
require __DIR__ . '/../frame/start.php';
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/10
 * Time: 9:46
 */
require FRAME_PATH . 'FrameAutoLoad.php';
// 注册自动加载方法
spl_autoload_register(array('FrameAutoLoad', 'autoload'));

// 启动框架方法
App::run();
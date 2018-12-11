<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// 载入composer自动加载  
require ROOT_PATH . '/vendor/autoload.php';

class App
{
    const CONTROLLER_PREFIX = '\\Jxc\\App\\Controller';

    public static function run()
    {
        // 启用 slim路由
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true, // 开启错误信息
            ],
        ];
        $c = new \Slim\Container($configuration);
        $app = new \Slim\App($c);
        $app->get('/', function (Request $request, Response $response, array $args) {
            header('location:/index/index');
        });

        $app->get('/{controller}/{method}', function (Request $request, Response $response, array $args) {
            // 新建控制器类 调用控制器方法
            $class_name = self::CONTROLLER_PREFIX .'\\'.ucfirst($args['controller']);
            if(!class_exists($class_name)){
                echo 'error class 不存在！';
                exit;
            }
			$class = new $class_name();
			$method = $args['method'];
            // 如果错误类也不存在，则抛出异常
            if(!is_callable(array($class,$method))){
                echo 'error method 不存在！';
                exit;
            }

            $class->{$args['method']}();

		});
        $app->run(); // 启动路由配置
    }
}


<?php
class FrameAutoLoad {
    /* 自动加载类 */
    public static function autoload($class) {
        //通过命名空间加载类
        if(false !== strpos($class, '\\')) {
            $file = trim($class, '\\');
            $file = explode('\\', $file);
            array_shift($file); // 去掉顶级命名空间
            $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $file);
            // 加载app下的文件
            $path = $file . '.php';
            if(file_exists($path)) {
                require $path;
                return ;
            }
            return ;
        }

        $path = FRAME_PATH . $class . '.php';
        if(file_exists($path)) {
            require $path;
            return ;
        }


    }
}

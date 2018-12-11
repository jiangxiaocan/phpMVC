<?php
namespace Jxc\Frame;
class View{
    use InstanceTrait;

    protected static $vars;

    private $viewExt = 'php';

    public function assign($key, $value)
    {
        self::$vars[$key] = $value;
        return $this;
    }

    public function render($view = null)
    {
        if (!$view) {
        }
        $viewFile = $this->getViewFile($view);
        self::$vars && extract(self::$vars);
        self::$vars = null;
        include $viewFile;
    }

    public function setViewExt($ext)
    {
        $this->viewExt = $ext;
    }

    public function getViewFile($view)
    {
        $viewFile = APP_PATH.'view'.DIRECTORY_SEPARATOR.$view.'.'.$this->viewExt;
        return $viewFile;
    }

}
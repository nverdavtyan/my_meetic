<?php
class Autoloader{
    static function push(){
        spl_autoload_register(array( __CLASS__, 'autoloader'));
    }

    static function autoloader($class){
        require('' . __DIR__ . '//' . $class . '.php');
    }

}


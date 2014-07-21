<?php

class Artx
{
    private static $_paths = array();

    public static function addPath($prefix, $path)
    {
        self::$_paths[$prefix . '_'] = rtrim($path, DIRECTORY_SEPARATOR);
    }
    
    public static function load($class)
    {
        if (class_exists($class))
            return;
        $includePath = dirname(__FILE__);
        foreach (self::$_paths as $prefix => $path) {
            if (0 === strpos($class, $prefix)) {
                $includePath = $path;
                $class = substr($class, strlen($prefix));
                break;
            }
        }
        $file = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        require_once $includePath . DIRECTORY_SEPARATOR . $file;
    }
}
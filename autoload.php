<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-16 12:03
 */
spl_autoload_register(function($className){
    $name = str_replace("feehi\\cdn\\", '', $className) . '.php';
    $name = str_replace("\\", "/", $name);
    $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src/';
    $fullFile = $path . $name;
    if(is_file($fullFile)) require $fullFile;
});
<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-16 14:36
 */

namespace feehi\cdn;

use Exception;

class DummyTarget extends TargetAbstract implements TargetInterface
{
    public $host = "";

    public function init()
    {
    }

    public function __set($key, $val)
    {
        $this->$key = $val;
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function upload($localFile, $destFile)
    {
        return true;
    }

    public function multiUpload($localFile, $destFile)
    {
        return true;
    }

    public function delete($destFile)
    {
        return true;
    }

    public function exists($destFile)
    {
        return false;
    }

    public function getCdnUrl($destFile)
    {
        if( empty($destFile) ) return '';
        if( strpos($destFile, '/') === 0 ){
            $destFile = substr($destFile, 1);
        }
        return $this->host . $destFile;
    }

    public function getClient()
    {
        throw new Exception("must use cdn can call this method");
    }
}
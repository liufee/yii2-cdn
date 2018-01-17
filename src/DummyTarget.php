<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-16 14:36
 */

namespace feehi\cdn;

class DummyTarget extends TargetAbstract implements TargetInterface
{
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
        return $destFile;
    }
}
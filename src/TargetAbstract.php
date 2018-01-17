<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-17 14:04
 */

namespace feehi\cdn;


use Exception;
use yii\base\Component;

abstract class TargetAbstract extends Component implements TargetInterface
{

    public $host;

    protected $lastError = null;

    protected $client;

    public function init()
    {
        parent::init();
        if( empty($this->bucket) ) throw new Exception("Cdn bucket cannot be blank");
        if( empty($this->host) ) throw new Exception("Cdn host cannot be blank");
        if (stripos($this->host, 'http://') !== 0 && stripos($this->host, 'https://') !== 0  && stripos($this->host, '//') !== 0) {
            throw new Exception("host must begin with http://, https:// or //");
        }
        if( $this->host[strlen($this->host) - 1] !== '/' ){
            $this->host .= '/';
        }
    }

    public function getLastError()
    {
        return is_string( $this->lastError ) ? $this->lastError : print_r($this->lastError, true);
    }

    public function getCdnUrl($destFile)
    {
        if( strpos($destFile, '/') === 0 ){
            $destFile = substr($destFile, 1);
        }
        return $this->host . $destFile;
    }

    public function getClient()
    {
        return $this->client;
    }
}
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
    }

    public function getLastError()
    {
        return is_string( $this->lastError ) ? $this->lastError : print_r($this->lastError, true);
    }

    public function getCdnUrl($destFile)
    {
        return $this->host . $destFile;
    }

    public function getClient()
    {
        return $this->client;
    }
}
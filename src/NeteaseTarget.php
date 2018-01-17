<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-17 10:52
 */

namespace feehi\cdn;

use Exception;
use NOS\Core\NosException;
use NOS\NosClient;

class NeteaseTarget extends TargetAbstract implements TargetInterface
{

    public $accessKey;

    public $accessSecret;

    public $bucket;

    public $endPoint;

    /** @var NosClient  */
    public $client;


    public function init()
    {
        parent::init();
        if( empty($this->accessKey) ) throw new Exception("Netease accessKey cannot be blank");
        if( empty($this->accessSecret) ) throw new Exception("Netease accessSecret cannot be blank");
        if( empty($this->endPoint) ) throw new Exception("Netease endPoint cannot be blank");
        $this->client = new NosClient($this->accessKey,$this->accessSecret,$this->endPoint);
    }

    public function upload($localFile, $destFile)
    {
        $destFile = $this->nomarlizeDestFilePath($destFile);
        try{
            $this->client->uploadFile($this->bucket, $destFile, $localFile);
            return true;
        } catch(NosException $e){
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function multiUpload($localFile, $destFile)
    {
        $destFile = $this->nomarlizeDestFilePath($destFile);
        try {
            $this->client->multiuploadFile($this->bucket, $destFile, $localFile, array());
            return true;
        }catch (Exception $e){
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function exists($destFile)
    {
        if(empty($destFile)) return false;
        $destFile = $this->nomarlizeDestFilePath($destFile);
        return $this->client->doesObjectExist($this->bucket, $destFile);
    }

    public function delete($destFile)
    {
        $destFile = $this->nomarlizeDestFilePath($destFile);
        try{
            $content = $this->client->deleteObject($this->bucket,$destFile);
            return true;
        } catch(NosException $e){
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    private function nomarlizeDestFilePath($destFile)
    {
        if( strpos($destFile, '/') === 0 ) $destFile = substr($destFile, 1);
        return $destFile;
    }
}
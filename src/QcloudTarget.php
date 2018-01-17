<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-16 14:46
 */

namespace feehi\cdn;

use Qcloud\Cos\Client;
use Exception;

class QcloudTarget extends TargetAbstract implements TargetInterface
{
    public $region;

    public $appId;

    public $secretId;

    public $secretKey;

    public $bucket;

    /** @var Client */
    protected $client;

    public function init()
    {
        parent::init();
        if( empty($this->region) ) throw new Exception("Qcloud region cannot be blank");
        if( empty($this->appId) ) throw new Exception("Qcloud appId cannot be blank");
        if( empty($this->secretId) ) throw new Exception("Qcloud secretId cannot be blank");
        if( empty($this->secretKey) ) throw new Exception("Qcloud secretKey cannot be blank");

        $this->client = new Client([
            'region' => $this->region,
            'credentials'=> [
                'secretId'    => $this->secretId,
                'secretKey' => $this->secretKey
            ]
        ]);
    }

    public function upload($localFile, $destFile)
    {

        try {
            $result = $this->client->upload(
                $bucket = $this->getWholeBucketName(),
                $key = $destFile,
                $body = fopen($localFile,'r+')
            );
            return true;
        } catch (\Exception $e) {
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function multiUpload($localFile, $destFile)
    {
        try {
            $result = $this->client->upload(
                $bucket = $this->getWholeBucketName(),
                $key = $destFile,
                $body = fopen($localFile, 'rb'),
                $options = array(
                    "ACL"=>'private',
                    'CacheControl' => 'private'));
            return true;
        } catch (\Exception $e) {
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function exists($destFile)
    {
        try {
            $result = $this->client->headObject(array('Bucket' => $this->getWholeBucketName(), 'Key' => $destFile));
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    public function delete($destFile)
    {
        try {
            $result = $this->client->deleteObject([
                    'Bucket' => $this->getWholeBucketName(),
                    'Key' => $destFile
                ]
            );
            return true;
        }catch (Exception $e){
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    private function getWholeBucketName()
    {
        //bucket的命名规则为{name}-{appid} ，此处填写的存储桶名称必须为此格式
        return $this->bucket . '-' . $this->appId;
    }
}
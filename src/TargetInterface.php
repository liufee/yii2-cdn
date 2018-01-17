<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-16 10:28
 */
namespace feehi\cdn;

interface TargetInterface
{

    /**
     * 上传文件
     *
     * @param $localFile string 本地文件，包含路径的文件名全路径，如/www/cms/frontend/web/uploads/article/thumb/xxx.png
     * @param $destFile string 远程文件，包含路径的文件名全路径，如/uploads/article/thumb/xxx.png
     * @return bool
     */
    public function upload($localFile, $destFile);

    /**
     * 大文件分片上传(自己无需分片，和调用upload一样即可)
     *
     * @param $localFile string 本地文件，包含路径的文件名全路径，如/www/cms/frontend/web/uploads/article/thumb/xxx.png
     * @param $destFile string 远程文件，包含路径的文件名全路径，如/uploads/article/thumb/xxx.png
     * @return bool
     */
    public function multiUpload($localFile, $destFile);

    /**
     * 检测远程文件是否存在
     *
     * @param $destFile string 远程文件，包含路径的文件名全路径，如/uploads/article/thumb/xxx.png
     * @return bool
     */
    public function exists($destFile);

    /**
     * 删除远程文件
     *
     * @param $destFile string 远程文件，包含路径的文件名全路径，如/uploads/article/thumb/xxx.png
     * @return bool
     */
    public function delete($destFile);

    /**
     * 获取文件的cdn url地址
     *
     * @param $destFile string 包含路径的文件名全路径，如/uploads/article/thumb/xxx.png
     * @return string 完整的cdn url,如:http://nos.126.com/uploads/article/thumb/xxx.png
     */
    public function getCdnUrl($destFile);

    /**
     * 获取相应cdn厂商sdk的实例
     *
     * @return mixed
     */
    public function getClient();

    /**
     * 获取最后一次的错误
     *
     * @return mixed
     */
    public function getLastError();
}
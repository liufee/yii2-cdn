<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-01-17 15:04
 */

/* @var $cdn \feehi\cdn\TargetInterface */
$cdn = \yii::$app->get('cdn');
$cdn->upload(__FILE__, 'test/demo.php');//上传文件
$cdn->multiUpload(__FILE__, 'test/demo-multi.php');//分片上传文件
print_r($cdn->exists('test/demo.php'));//判断文件是否存在
$cdn->delete('test/demo.php');//删除文件
$cdn->getLastError();//获取最后一次上传/删除文件产生的错误信息，一般在upload/delete返回false时使用
$cdn->getCdnUrl('test/demo.php');//获取cdn url
$cdn->getClient();//获取厂商sdk实例,可以阅读相应厂商api调用相关方法
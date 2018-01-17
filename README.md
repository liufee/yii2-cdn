yii2 cdn
===============================

yii2 cdn，支持 七牛、网易云、腾讯云、阿里云的cdn。可以随时使用/取消yii2项目使用cdn。


安装
---------------
1. 使用composer
     composer的安装以及国内镜像设置请点击[此处](http://www.phpcomposer.com/)
     
     ```bash
     $ cd /path/to/yii2-app
     $ composer require "feehi/yii2-cdn"
     $ composer install -vvv
     ```
2. 手动导入
    下载yii2-cdn包后放置在任意目录
    然后在yii2 index.php中
    ```php
       require "/path/to/yii2-cdn/autoload.php";
    ```
 

配置
-------------
yii2 cdn是作为一个组件提供服务的，所以得配置yii2 cdn组件。打开common/config/main.php在components块内增加

1.使用七牛的配置
```php
    'components' => [
        'cdn' => [
            'class' => feehi\cdn\QiniuTarget::className(),
            'accessKey' => 'xxxxxxx',
            'secretKey' => 'xxxxxxxxx',
            'bucket' => 'xxx',
            'host' => 'http://xxxx.xxx.com'
        ]
    ]
```

2.使用阿里云的配置
```php
    'components' => [
        'cdn' => [
            'class' => feehi\cdn\AliossTarget::className(),
            'bucket' => 'xxx',
            'accessKey' => 'xxxx',
            'accessSecret' => 'xxxxxxx',
            'endPoint' => 'oss-cn-beijing.aliyuncs.com',
            'host' => 'http://xxxx.xxx.com'
        ]
    ]
```

3.使用腾讯云的配置
```php
    'components' => [
        'cdn' => [
            'class' => feehi\cdn\QcloudTarget::className(),
            'appId' => 'xxxxx',
            'secretId' => 'xxxxxx',
            'secretKey' => 'xxxxxxx',
            'region' => 'tj',
            'bucket' => 'xxx',
            'host' => 'http://image-1251086492.costj.myqcloud.com',
        ]
    ]
```

4.使用网易云的配置
```php
    'components' => [
        'cdn' => [
            class' => feehi\cdn\NeteaseTarget::className(),
            'accessKey' => 'xxxxx',
            'accessSecret' => 'xxxxxxx',
            'endPoint' => 'nos-eastchina1.126.net',
            'bucket' => 'xxx',
            'host' => 'http://xxxx.xxx.com'
        ]
    ]
```

5.不使用cdn时的配置(不需要修改代码文件)
```php
    'components' => [
        'cdn' => [
            class' => feehi\cdn\DummyTarget::className(),
        ]
    ]
```


示例
-------------
见[examples/demo.php](examples/demo.php)


说明
-------------
yii2 cdn集成了国内常用四个cdn厂商的sdk，以yii2组件的方式提供服务，屏蔽了厂商不同的api名称、调用方式。但是yii2 cdn只实现了几个常用的api：上传文件 分片上传 检测文件是否存在 删除文件。其他相应的操作需要自行实现。
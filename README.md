七牛实验室
=========

这是一个用来快速体验七牛云存储服务的小项目。使用php编写。所引用的七牛PHP的SDK版本是6.1.9。

这个项目的运行目前只需要一个PHP基本环境即可，不需要任何框架的知识。需要注意的是PHP的SDK需要curl模块的支持。

您可以fork这个项目或者clone一个副本到本地的Web运行环境中。修改`header.php`文件里面的全局变量`$APP_ROOT`为您本地的实际项目地址即可运行。

另外为了演示七牛的文件上传，管理等功能，需要您设置`qiniu_config.php`文件里面的`$Qiniu_AccessKey`, `$Qiniu_SecretKey`和`$Qiniu_Public_Bucket`的
值为您实际的值。

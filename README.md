# laravel-anothor-json

Yet Another JSON Encoder For Laravel.
用于修复 PHP7 中 json_encode 函数溢出的问题.

## 安装

1. 安装包文件

  ```shell
  composer require "seekerliu/laravel-another-json:dev-master"
  ```

## 配置

### Laravel 5.5
1. 注册 `ServiceProvider` 及 `Facade`:

  ```shell
  php artisan package:discover
  ```

2. 创建配置文件：
 
  ```shell
  php artisan vendor:publish
  ```
  
### Laravel 5.4 及以下
1. 注册 `ServiceProvider` 及 `Facade`:

  ```php
  'providers' => [
      //...
      
      Seekerliu\YaJson\ServiceProvider::class,
  ],
  
  'aliases' => [
      //...
      
      'YaJson' => Seekerliu\YaJson\Facade::class,
  ],
  ```
 

2. 创建配置文件：

  ```shell
  php artisan vendor:publish --provider="Seekerliu\YaJson\ServiceProvide"
  ```
  

## License

MIT

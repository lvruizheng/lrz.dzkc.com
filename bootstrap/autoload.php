<?php
/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so we do not have to manually load any of
| our application's PHP classes. It just feels great to relax.
|
*/
//这个不需要改*** 因为这个是自动加载当前项目的类
require __DIR__.'/../vendor/autoload.php';

//这个修改为引入框架的自动加载类，加载框架核心和第三方类库
require LARAVEL_DIR.'/bootstrap/autoload.php';

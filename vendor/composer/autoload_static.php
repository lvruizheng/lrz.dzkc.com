<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitabcd4d2239e646ea3622f6ba475d17f9
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Console\\Kernel' => __DIR__ . '/../..' . '/app/Console/Kernel.php',
        'App\\Exceptions\\Handler' => __DIR__ . '/../..' . '/app/Exceptions/Handler.php',
        'App\\Http\\Controllers\\Auth\\ForgotPasswordController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/ForgotPasswordController.php',
        'App\\Http\\Controllers\\Auth\\LoginController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/LoginController.php',
        'App\\Http\\Controllers\\Auth\\RegisterController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/RegisterController.php',
        'App\\Http\\Controllers\\Auth\\ResetPasswordController' => __DIR__ . '/../..' . '/app/Http/Controllers/Auth/ResetPasswordController.php',
        'App\\Http\\Controllers\\Controller' => __DIR__ . '/../..' . '/app/Http/Controllers/Controller.php',
        'App\\Http\\Controllers\\HomeController' => __DIR__ . '/../..' . '/app/Http/Controllers/HomeController.php',
        'App\\Http\\Kernel' => __DIR__ . '/../..' . '/app/Http/Kernel.php',
        'App\\Http\\Middleware\\EncryptCookies' => __DIR__ . '/../..' . '/app/Http/Middleware/EncryptCookies.php',
        'App\\Http\\Middleware\\RedirectIfAuthenticated' => __DIR__ . '/../..' . '/app/Http/Middleware/RedirectIfAuthenticated.php',
        'App\\Http\\Middleware\\TrimStrings' => __DIR__ . '/../..' . '/app/Http/Middleware/TrimStrings.php',
        'App\\Http\\Middleware\\VerifyCsrfToken' => __DIR__ . '/../..' . '/app/Http/Middleware/VerifyCsrfToken.php',
        'App\\Models\\Article' => __DIR__ . '/../..' . '/app/Models/Article.php',
        'App\\Models\\Comment' => __DIR__ . '/../..' . '/app/Models/Comment.php',
        'App\\Page' => __DIR__ . '/../..' . '/app/Page.php',
        'App\\Providers\\AppServiceProvider' => __DIR__ . '/../..' . '/app/Providers/AppServiceProvider.php',
        'App\\Providers\\AuthServiceProvider' => __DIR__ . '/../..' . '/app/Providers/AuthServiceProvider.php',
        'App\\Providers\\BroadcastServiceProvider' => __DIR__ . '/../..' . '/app/Providers/BroadcastServiceProvider.php',
        'App\\Providers\\EventServiceProvider' => __DIR__ . '/../..' . '/app/Providers/EventServiceProvider.php',
        'App\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/app/Providers/RouteServiceProvider.php',
        'App\\User' => __DIR__ . '/../..' . '/app/User.php',
        'ArticleSeeder' => __DIR__ . '/../..' . '/database/seeds/ArticleSeeder.php',
        'CreateArticleTable' => __DIR__ . '/../..' . '/database/migrations/2017_07_13_113354_create_article_table.php',
        'CreateCommentsTable' => __DIR__ . '/../..' . '/database/migrations/2017_07_13_105311_create_comments_table.php',
        'CreatePasswordResetsTable' => __DIR__ . '/../..' . '/database/migrations/2014_10_12_100000_create_password_resets_table.php',
        'CreateUsersTable' => __DIR__ . '/../..' . '/database/migrations/2014_10_12_000000_create_users_table.php',
        'DatabaseSeeder' => __DIR__ . '/../..' . '/database/seeds/DatabaseSeeder.php',
        'Tests\\CreatesApplication' => __DIR__ . '/../..' . '/tests/CreatesApplication.php',
        'Tests\\Feature\\ExampleTest' => __DIR__ . '/../..' . '/tests/Feature/ExampleTest.php',
        'Tests\\TestCase' => __DIR__ . '/../..' . '/tests/TestCase.php',
        'Tests\\Unit\\ExampleTest' => __DIR__ . '/../..' . '/tests/Unit/ExampleTest.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitabcd4d2239e646ea3622f6ba475d17f9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitabcd4d2239e646ea3622f6ba475d17f9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitabcd4d2239e646ea3622f6ba475d17f9::$classMap;

        }, null, ClassLoader::class);
    }
}

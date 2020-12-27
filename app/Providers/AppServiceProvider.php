<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
          * flysystem に sftp 用のアダプタを追加する
          * @see https://flysystem.thephpleague.com/docs/adapter/sftp/
          * @see https://readouble.com/laravel/5.5/ja/filesystem.html#custom-filesystems
          */
        Storage::extend('sftp', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });
    }
}

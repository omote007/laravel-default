<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
class LaravelSftpController extends Controller
{
    public function index(){
        Log::debug('デバッグメッセージ');
        Log::debug('ログサンプル', ['memo' => 'sample1']);
        error_log("error log test. output to file(test.log)\n",3,"./test.log");
        echo 'ログ出力完了';
        exit;

        //sambauserにファイルを作成
        $local_dir_pass = '..\..\broonie\images_tmp\\';
        $network_dir_pass = "omote/";
        $move_file_name = 'test.txt';
        $file_obj = new File(storage_path($local_dir_pass.$move_file_name));
        \Storage::disk('sambauser')->putFileAs($network_dir_pass, $file_obj,$move_file_name);
        unlink($local_dir_pass.$move_file_name);
        echo 'ファイルコピー完了';
        exit;
        //実行URL
        //http://localhost/sftp/public/laravelsftp
    }

    private function cut_pass_from_file_name($file_name){
        return basename($file_name);
    }
}

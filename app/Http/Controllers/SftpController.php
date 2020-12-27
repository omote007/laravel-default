<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\File;

class SftpController extends Controller
{
    public function index(){
       //実行URL
        //http://localhost/sftp/public/sftp
        $now_datetime = date('Y-m-d H:i:s');
        error_log("[$now_datetime] 実行開始\n",3,"./sftp.log");

        //移動パス設定
        $local_dir_pass = '..\..\broonie\\';
        $network_dir_pass = "omote/";

        //SSH接続設定
        $connection = ssh2_connect('160.16.234.220', 61203);//SSH接続先
        ssh2_auth_password($connection, 'sambauser', 'samba1ban');//linuxログインユーザー
        $sftp = ssh2_sftp($connection);
        ini_set('max_execution_time', 60000);
        //ストレージサーバに移動させるディレクトリ名一覧の取得
        $arr_dir_name =  ['images_tmp','images_tmp2'];
        foreach($arr_dir_name as $dir_name){
            echo $dir_name;
            ob_flush();
            flush();
            ssh2_sftp_mkdir($sftp, $network_dir_pass.$dir_name);
            //ディレクトリ内のファイル名一覧を取得
            $arr_file_name = array_map(array($this, 'cut_pass_from_file_name'),glob("$local_dir_pass$dir_name/*.*"));
            foreach($arr_file_name as $key => $file_name){
                $local_full_pass = $local_dir_pass.$dir_name.'\\'.$file_name;
                $network_full_pass = $network_dir_pass.$dir_name.'/'.$file_name;
                ssh2_scp_send($connection, $local_full_pass, $network_full_pass, 0644);
                $sftp_pass = 'ssh2.sftp://'.intval($sftp).'/home/sambauser/'.$network_full_pass; //ルートディレクトリから指定する必要あり
                $now_datetime = date('Y-m-d H:i:s');
                if(file_exists($sftp_pass)){
                    unlink($local_full_pass);
                    error_log("[$now_datetime] 移動成功($network_full_pass) [$key]\n",3,"./sftp.log");
                }else{
                    error_log("移動失敗($network_full_pass)\n",3,"./sftp.log");
                }
                echo $key;
                ob_flush();
                flush();
            }
        }
        echo "コピペ完了";
        $now_datetime = date('Y-m-d H:i:s');
        error_log("[$now_datetime] 実行終了\n",3,"./sftp.log");
        exit;
    }

    private function cut_pass_from_file_name($file_name){
        return basename($file_name);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hashids\Hashids;
use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;
use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;
use LordDashMe\ImageSqueezer\ImageSqueezer;


class ChatController extends Controller
{
    public function index() {
        \Log::debug('画面描画成功');

        $id = 123456; //変換したいID
        $salt = "xxxxxx"; //変換のときに使う文字列
        $hashids = new Hashids($salt, 20);//Hash後の文字数指定        
        $hashid = $hashids->encode($id,123,'345');
        var_dump($hashid);//1vQd5
        $decode_id = $hashids->decode($hashid);
        var_dump($decode_id);//1vQd5

        $regex = new \VerbalExpressions\PHPVerbalExpressions\VerbalExpressions();
        $regex->startOfLine()
              ->then("http")
              ->maybe("s")
              ->then("://")
              ->maybe("www.")
              ->anythingBut(" ")
              ->endOfLine();
        var_dump($regex->test('https://b3s.be-s.co.jp/'));
        var_dump($regex->test('xxxxx://b3s.be-s.co.jp/'));


        $imageSqueezer = new ImageSqueezer();
        $imageSqueezer->load();
        $imageSqueezer->setSourceFilePath('before.JPG');
        $imageSqueezer->setOutputFilePath('after.JPG');
        $imageSqueezer->compress();



        return view('chat'); // フォームページのビュー
            
    }
}

<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageCreated;

class ChatController extends Controller
{
    public function index() {// 新着順にメッセージ一覧を取得
        \Log::debug('index');
        
        return Message::orderBy('id', 'desc')->get();
    
    }
    public function create(Request $request) { // メッセージを登録
        \Log::debug('create');
        
        $message = Message::create([
            'body' => $request->message
        ]);
        \Log::debug('create2');
        event(new MessageCreated($message));
        \Log::debug('create3');
    
    }
}

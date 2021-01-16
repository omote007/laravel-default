<?php

namespace App\Http\Controllers; //カレントディレクトリ
use App\Services\TopService as Service; //利用するクラス
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(Service $service,Request $request){ //メソッドインジェクション
        $arr_data = [];
        $arr_data['test'] = 'test';
        $arr_data['service_test'] = $service->test();
        $arr_data['util_test'] = $service->util_test();
        $arr_data['util_test'] = $service->model_test();             
        return view('top',$arr_data);
    }
}

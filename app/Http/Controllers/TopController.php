<?php

namespace App\Http\Controllers; //カレントディレクトリ
use App\Services\TopService as Service; //利用するクラス
use Illuminate\Http\Request;
use Carbon\Carbon;

class TopController extends Controller
{
    public function index(Service $service,Request $request){ //メソッドインジェクション
        $arr_data = [];
        $arr_data['test'] = 'test';
        $arr_data['service_test'] = $service->test();
        $arr_data['util_test'] = $service->util_test();
        $arr_data['util_test'] = $service->model_test();
        $arr_data['now_date'] = Carbon::now()->format('Y-m-d');
        var_dump($arr_data['now_date']);

        return view('top',$arr_data);
    }
}

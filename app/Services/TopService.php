<?php

namespace App\Services;
use App\Models\TopModel as TopModel;

class TopService
{
    public function test()
    {
        return 'service_test';
    }
    public function util_test(){
        return \Util::test(); //ファサード(staticなクラス)を呼ぶときは「\」をつける
    }
    public function model_test(){
        return TopModel::first();
    }
}
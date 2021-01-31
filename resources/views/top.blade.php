@extends('base')
@section('title','音ピタTOP')
@section('content')
    <h1>{{$test}}</h1>
    <h1>{{$service_test}}</h1>
    <h1>{{$util_test}}</h1>
    <h1>{{$now_date}}</h1>

<div id="app">
    <v-hello></v-hello>
</div>
@endsection

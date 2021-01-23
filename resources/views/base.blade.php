<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../resources/css/common.css">
    <!-- ↓この中にVue本体からコンポーネントまで全て入っています -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    @include('component.header')

    <div class='content'>
        @yield('content')
    </div>

    @include('component.footer')
</body>
</html>
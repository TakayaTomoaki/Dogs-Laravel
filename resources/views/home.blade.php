@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-b-md">
                <div class="card-header">ホーム</div>
            </div>
            <div class="card m-b-md">
                <div class="card-header">シェア</div>
                <div class="card-body">
                    <div class="links">
                        {{-- <a href="{{ action('HomeController@add', ['id' => $id]) }}">ホーム</a></br>
                        <a href="{{ action('MypageController@add', ['id' => $id]) }}">マイページ</a></br>
                        <a href="{{ action('SearchController@add', ['id' => $id]) }}">検索</a></br>
                        <a href="{{ action('NoticeController@add', ['id' => $id]) }}">通知</a></br>
                        <a href="{{ action('MessagesController@add', ['id' => $id]) }}">メッセージ</a></br>
                        <a href="{{ action('SetupController@add', ['id' => $id]) }}">設定</a> --}}
                        <a href="http://192.168.3.25/~ubuntu/dogs/home">ホーム</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/mypage">マイページ</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/search">検索</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/notice">通知</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/messages">メッセージ</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/setup">設定</a>
                    </div>
                </div>
            </div>
            <div class="card m-b-md">
                <div class="card-header">シェア一覧</div>
                <div class="card-body">
                    <div class="links">
                        {{-- <a href="{{ action('HomeController@add', ['id' => $id]) }}">ホーム</a></br>
                        <a href="{{ action('MypageController@add', ['id' => $id]) }}">マイページ</a></br>
                        <a href="{{ action('SearchController@add', ['id' => $id]) }}">検索</a></br>
                        <a href="{{ action('NoticeController@add', ['id' => $id]) }}">通知</a></br>
                        <a href="{{ action('MessagesController@add', ['id' => $id]) }}">メッセージ</a></br>
                        <a href="{{ action('SetupController@add', ['id' => $id]) }}">設定</a> --}}
                        <a href="http://192.168.3.25/~ubuntu/dogs/home">ホーム</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/mypage">マイページ</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/search">検索</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/notice">通知</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/messages">メッセージ</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/setup">設定</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

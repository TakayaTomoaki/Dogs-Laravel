@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">検索</div>

                <div class="links">
                    <a href="{{ route( 'home') }}">ホーム</a><br>
                    <a href="{{ route( 'mypage', ['user_id' => $user_id]) }}">マイページ</a><br>
                    <a href="{{ route( 'search') }}">検索</a><br>
                    <a href="{{ route( 'notice', ['user_id' => $user_id]) }}">通知</a><br>
                    <a href="{{ route( 'messages', ['user_id' => $user_id]) }}">メッセージ</a><br>
                    <a href="{{ route( 'setup', ['user_id' => $user_id]) }}">設定</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

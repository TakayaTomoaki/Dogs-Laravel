@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">プロフィール</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">愛犬ネーム ： {{ $dog_prof->dog_name }}</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">年齢：
                                {{ $dog_age }} 歳
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">性別 ：
                                {{ $dog_gender }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">体重 ：
                                {{ $dog_prof->dog_weight }} kg
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">父犬種 ：
                                {{ config('dogbreed.breeds')[$dog_prof->dog_father] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">母犬種 ：
                                {{ config('dogbreed.breeds')[$dog_prof->dog_mother] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">愛犬紹介欄 ：
                                {{ $dog_prof->dog_introduction }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-md">
                    <div class="card-header">シェア一覧</div>
                    <div class="card-body">
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
                <div class="card m-b-md">
                    <div class="card-header">いいね一覧</div>
                    <div class="card-body">
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
    </div>
@endsection

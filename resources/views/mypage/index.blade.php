@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">マイページ</div>
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
                <div class="card">
                    <div class="card-header">プロフィール</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">愛犬ネーム ： {{ $prof_data->dog_name }}</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">年齢：
                                {{ $dog_age }} 歳
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">性別 ：
                                {{ $dog_gender }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">体重 ：
                                {{ $prof_data->dog_weight }} kg
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">父犬種 ：
                                {{ config('dogbreed.breeds')[$prof_data->dog_father] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">母犬種 ：
                                {{ config('dogbreed.breeds')[$prof_data->dog_mother] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">愛犬紹介欄 ：
                                {{ $prof_data->dog_introduction }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end m-b-md">
                    <div class="btn btn-primary">
                        <a href="{{ route('edit', ['user_id'=> $user_id]) }}" class="btn-primary">プロフィール変更</a>
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

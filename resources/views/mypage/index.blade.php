@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card m-b-md">
                <div class="card-header">マイページ</div>

                <div class="card-body">
                    <div class="links">
                        <a href="http://192.168.3.25/~ubuntu/dogs/home">ホーム</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/mypage">マイページ</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/search">検索</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/notice">通知</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/messages">メッセージ</a></br>
                        <a href="http://192.168.3.25/~ubuntu/dogs/setup">設定</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">プロフィール</div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">愛犬ネーム ： {{ $is_dog->dog_name }}</div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">生年月日：
                            {{ $is_dog->dog_age }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">性別 ：
                            {{ config('gender.gender')[$is_dog->dog_gender] }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">体重 ：
                            {{ $is_dog->dog_weight }} kg
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">父犬種 ：
                            {{ config('dogbreed.breeds')[$is_dog->dog_father] }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">母犬種 ：
                            {{ config('dogbreed.breeds')[$is_dog->dog_mother] }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">愛犬紹介欄 ：
                            {{ $is_dog->dog_introduction }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end m-b-md">
                <div class="btn btn-primary">
                    {{-- <a href="http://192.168.3.25/~ubuntu/dogs/mypage/profile" class="btn-primary">プロフィール設定</a> --}}
                    <a href="{{ action('MypageController@edit', ['id' => $is_dog]) }}" class="btn-primary">プロフィール設定</a>
                </div>
            </div>
            <div class="card m-b-md">
                <div class="card-header">シェア一覧</div>
                <div class="card-body">
                    <div class="links">
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
                <div class="card-header">いいね一覧</div>
                <div class="card-body">
                    <div class="links">
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

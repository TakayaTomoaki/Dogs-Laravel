@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">
                    <a href="{{ action('SetupController@edit', ['id' => $id]) }}">ユーザー設定</a>
                </div>
                <div class="card-body">
                    <a href="http://192.168.3.25/~ubuntu/dogs/setup/account">アカウント管理</a>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

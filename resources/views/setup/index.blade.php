@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">
                    <a href="{{ route('user', ['user_id' => $user_id]) }}">ユーザー設定</a>
                </div>
                <div class="card-body">
                    <a href="{{ route('account', ['user_id' => $user_id]) }}">アカウント管理</a>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

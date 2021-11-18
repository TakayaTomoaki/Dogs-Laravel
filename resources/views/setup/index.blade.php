@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body px-0 py-0">
                    <div class="list-group list-group-flush">
                    <a href="{{ route('user', ['user_id' => $user_id]) }}" class="list-group-item list-group-item-action">
                        ユーザー設定
                    </a>
                    <a href="{{ route('account', ['user_id' => $user_id]) }}" class="list-group-item list-group-item-action">
                        アカウント管理
                    </a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

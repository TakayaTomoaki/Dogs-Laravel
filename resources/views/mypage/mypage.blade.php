@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <div class="col">
                プロフィール
              </div>
              {{--ユーザー情報によりボタン表示を変更--}}
              @if($user_id === (int)Auth::id())
                <div class="btn btn-secondary btn-sm">
                  <a href="{{ route('create') }}"
                     class="btn-secondary">プロフィール設定</a>
                </div>
              @endif
            </div>
          </div>

          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6">愛犬ネーム ： </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">年齢： </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">性別 ： </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">体重 ： </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">父犬種 ： </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">母犬種 ： </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">愛犬紹介欄 ： </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

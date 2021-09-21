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
        <div class="d-flex justify-content-end">
          <div class="btn btn-primary">
            <a href="{{ action('MypageController@create') }}" class="btn-primary">プロフィール設定</a>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

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
            <div class="col-md-6">愛犬ネーム ： </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">生年月日： </div>
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
          <a href="http://192.168.3.25/~ubuntu/dogs/mypage/profile" class="btn-primary">プロフィール設定</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

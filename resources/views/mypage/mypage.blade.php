@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
                マイページ
              {{--ユーザー情報によりボタン表示を変更--}}
          </div>

          <div class="card-body pb-2">
            <div class="media d-flex">
              <svg class="bd-placeholder-img rounded mr-3" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
                   preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
                <title>Generic placeholder image</title>
                <rect width="100%" height="100%" fill="#868e96"/>
              </svg>
              {{--ユーザー情報によりボタン表示を変更--}}
              <div class="media-body">
                <div class="row align-items-center pt-1">
                  <div class="font-weight-bold col h6 text-dark pt-2">
                  </div>
                  <div class="justify-content-end">
                    @if($user_id === (int)Auth::id())
                      <div class="btn btn-outline-secondary btn-sm rounded-pill">
                        <a href="{{ route('create') }}" class="btn-outline-secondary">プロフィール設定</a>
                      </div>
                      @endif
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col ml-3">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-body py-0 mx-2">
            <div class="row">
              <div class="col h6 mb-0 small">年齢： 歳</div>
              <div class="col h6 mb-0 small">性別 ：</div>
              <div class="col h6 mb-0 small">体重 ： kg</div>
            </div>
            <div class="row">
              <div class="col h6 mb-0 small">父犬種 ：</div>
            </div>
            <div class="row">
              <div class="col h6 mb-0 small">母犬種 ：</div>
            </div>
            <div class="row py-2">
              <div class="col"></div>
            </div>
            <hr class="my-0">
            <div class="row d-flex py-2">
              <p class="mb-0 ml-3"> フォロー中</p>
              <p class="mb-0 ml-5"> フォロワー</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

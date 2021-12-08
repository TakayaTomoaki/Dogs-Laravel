@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">アカウント設定</div>

          <div class="card-body">

            <div class="col my-4 py-1">
              <h5 class="text-center">ログアウトしますか？</h5>
            </div>
            <div class="row text-center my-4">
              <div class="col">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary" style="width:130px">
                    ログアウトする
                  </button>
                </form>

              </div>
              <div class="col">
                <form action="{{ route('setup', ['user_id'=> $user_id]) }}" method="GET">
                  <button type="submit" class="btn btn-primary" style="width:130px">
                    戻る
                  </button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

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
              <div class="col mx-4">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary btn-block">
                    ログアウトする
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

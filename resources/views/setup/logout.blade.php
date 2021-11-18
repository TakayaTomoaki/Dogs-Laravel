@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">アカウント設定</div>

          <div class="card-body px-0 py-0">
            <div class="list-group list-group-flush">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action">
                  ログアウトする
                </button>
              </form>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
@endsection

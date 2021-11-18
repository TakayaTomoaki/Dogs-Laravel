@extends('layouts.profile')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">ユーザー設定</div>

          <div class="card-body">
            <form action="{{ action('SetupController@update', ['user_id' => $user_id]) }}" method="post" enctype="multipart/form-data">

              @if (count($errors) > 0)
                <ul class="text-danger">
                  @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                  @endforeach
                </ul>
              @endif

              <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-md-right">ユーザーネーム</label>
                <div class="col-md-7">
                  <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name"
                         value="{{ $user_form->name }}" required autocomplete="name" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="location" class="col-md-3 col-form-label text-md-right">居住地</label>
                <div class="col-md-7">
                  <select type="text" class="form-control" name="location" id="location">
                    @foreach(config('prefecture.prefs') as $index => $location)
                      <option value="{{ $index }}" @if($user_form->location===$index) selected @endif>
                        {{ $location }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label text-md-right">メールアドレス</label>
                <div class="col-md-7">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                         name="email" value="{{ $user_form->email }}" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-3 col-form-label text-md-right">パスワード</label>
                <div class="col-md-7">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                         name="password" required autocomplete="new-password" value="{{ $user_form->password }}">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-3">
                  <input type="hidden" name="id" value="{{ $user_form->id }}">
                  {{ csrf_field() }}
                </div>
                <div class="col-md-7 justify-content-center">
                  <input type="submit" class="btn btn-primary btn-block" value="更新">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

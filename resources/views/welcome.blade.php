<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Dogs</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/common.css') }}" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<body>
<div class="flex-center position-ref full-height">
  @if (Route::has('login'))
    <div class="top-right links">
      @auth
        <a href="{{ url('/home') }}">Home</a>
      @else
        <a href="{{ route('login') }}">ログイン</a>

        @if (Route::has('register'))
          <a href="{{ route('register') }}">アカウント作成</a>
        @endif
      @endauth
    </div>
  @endif

  <div class="row align-items-center justify-content-center">
    <div class="content">
      <div class="title m-b-md font-weight-bold font-italic">
        Dogs
        <div class="fa-stack fa-2x d-flex">
          <i class="fas fa-square fa-stack-2x"></i>
          <i class="fas fa-dog fa-stack-1x fa-inverse" style="color:white"></i>
        </div>
      </div>
    </div>

    <div style="width:280px">
      <div class="card mb-2">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body py-2">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row mb-1">
              <div class="col-12">
                <label for="email" class="col-form-label pb-0">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" size="100" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-1">
              <div class="col-12">
                <label for="password" class="col-form-label pb-0">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-1">
              <div class="col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block">
                  {{ __('Login_at') }}
                </button>

                @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                  </a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="card">
      @if (Route::has('register'))
        <div class="card-body col ml-2 py-2">
          アカウントをお持ちでないですか？
          <br>
          <a href="{{ route('register') }}">登録する</a>
        </div>
      @endif
      </div>

    </div>


  </div>

</div>
</body>

</html>

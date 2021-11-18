@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card m-b-md">
          <div class="card-header">ホーム</div>
          <div class="card-body">
            @if (count($errors) > 0)
              <ul class="text-danger">
                @foreach($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            @endif

            <div class="media">
              <div class="object">
                <a href="{{ route('mypage', ['user_id' => $user_id])}}">

                  @if(!empty($dog->dog_image))
                    <img src="{{ asset('storage/dog_image/'.$dog->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
                  @else
                    <svg class="bd-placeholder-img rounded align-self-start mr-2" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
                         preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
                      <title>Generic placeholder image</title>
                      <rect width="100%" height="100%" fill="#868e96"/>
                    </svg>
                  @endif
                </a>
              </div>

              <div class="media-body">
                <form action="{{ route('share') }}" method="post" enctype="multipart/form-data">
                  <div class="form-group mb-0 col">
                    <textarea class="form-control @error('text') is-invalid @enderror" name="body" required autocomplete="text" rows="4" cols="100" maxlength="200" placeholder="みんなにシェアしよう！">{{ old('text') }}</textarea>
                    <div class="text-right">
                      <p class="text-danger mb-0">200文字以内</p>
                    </div>
                  </div>
                  <div class="form-group col">
                    <div class="col">
                      <label class="mb-0 d-flex">
                        <span class="btn btn-sm rounded-circle p-0 border-0 view_box" type="button">
                          <i class="far fa-image fa-3x"></i>
                          <input type="file" class="file form-control-file" style="display:none" name="image" accept="image/png, image/jpeg">
                        </span>
                      </label>

                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-primary btn-sm rounded-pill float-right">
                        シェアする
                      </button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

        @if(!empty($shares))
          <div class="card m-b-md">
            <div class="card-header">シェア一覧</div>
            <input type="hidden" id="count" value="{{ count($shares) }}">

            @foreach($shares as $post)

              @include('layouts.postIndex')

            @endforeach
            <div id="card"></div>
            <input type="hidden" id="done" value="0">
          </div>
        @endif

      </div>
    </div>
  </div>
@endsection

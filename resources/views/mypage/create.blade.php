@extends('layouts.profile')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            愛犬プロフィール作成
          </div>
          <div class="card-body">
            <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">

              @if (count($errors) > 0)
                <ul class="text-danger">
                  @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                  @endforeach
                </ul>
              @endif

              <div class="form-group row">
                <label for="dog_name" class="col-md-3 col-form-label text-md-right">愛犬名</label>
                <div class="col-md-7">
                  <input class="form-control @error('dog_name') is-invalid @enderror" id="dog_name" type="text" name="dog_name"
                         value="{{ old('dog_name') }}" required autofocus>
                  @error('dog_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="datepicker" class="col-md-3 col-form-label text-md-right">生年月日</label>
                <div class="col-md-7">
                  <input class="form-control @error('dog_birthday') is-invalid @enderror" type="text" id="datepicker"
                         name="dog_birthday" placeholder="日付を選択してください"  required value="{{ old('dog_birthday') }}">
                  @error('dog_birthday')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>


              <div class="form-group row align-items-center">
                <label for="dog_gender" class="col-md-3 col-form-label text-md-right">性別</label>
                <div class="col-md-7">
                  <div class="form-check form-check-inline form-check-inline" required>
                    <input class="form-check-input ml-2 @error('dog_gender') is-invalid @enderror" type="radio" name="dog_gender" value="0" id="dog_gender">
                    <label class="form-check-label @error('dog_gender') is-invalid @enderror">オス</label>
                    <input class="form-check-input ml-3 @error('dog_gender') is-invalid @enderror" type="radio" name="dog_gender" value="1">
                    <label class="form-check-label @error('dog_gender') is-invalid @enderror">メス</label>
                  </div>
                  @error('dog_gender')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="dog_weight" class="col-md-3 col-form-label text-md-right">体重</label>
                <div class="col-md-7">
                  <select type="number" class="form-control @error('dog_weight') is-invalid @enderror" name="dog_weight" id="dog_weight" required>
                    <option value="">- 選択してください -</option>
                    @for($i=1; $i<=100; $i++)
                      <option value='{{ $i }}'>{{ $i }} kg</option>
                    @endfor
                  </select>
                  @error('dog_weight')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="dog_father" class="col-md-3 col-form-label text-md-right">父犬種</label>
                <div class="col-md-7">
                  <select id="dog_father" type="text" class="form-control @error('dog_father') is-invalid @enderror" name="dog_father" required>
                    <option value="">- 選択してください -</option>

                    @foreach(config('dogbreed.breeds') as $key => $breed)
                      <option value="{{ $key }}" required>{{ $breed }}</option>
                    @endforeach
                  </select>
                  @error('dog_father')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="dog_mother" class="col-md-3 col-form-label text-md-right">母犬種</label>
                <div class="col-md-7">
                  <select id="dog_mother" type="text" class="form-control @error('dog_mother') is-invalid @enderror" name="dog_mother" required>
                    <option value="">- 選択してください -</option>
                    @foreach(config('dogbreed.breeds') as $key => $breed)
                      <option value="{{ $key }}">{{ $breed }}</option>
                    @endforeach
                  </select>
                  @error('dog_mother')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="dog_introduction" class="col-md-3 col-form-label text-md-right">愛犬紹介</label>
                <div class="col-md-7">
                  <textarea id="dog_introduction" class="form-control @error('dog_introduction') is-invalid @enderror" name="dog_introduction" rows="4" placeholder="・食べているフード　・好きな遊び　・性格　・行きつけのドッグラン　など" required></textarea>
                  <div class="text-right">
                    <p class="text-danger mb-0">200文字以内</p>
                  </div>
                  @error('dog_introduction')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="dog_image" class="col-md-3 col-form-label text-md-right">画像</label>
                <div class="col-md-7 view_box">
                  <input id="dog_image" type="file" class="form-control-file file" name="dog_image" accept="image/png, image/jpeg">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-3">
                  <input type="hidden" name="user_id" value="{{ $user_id }}">
                  {{ csrf_field() }}
                </div>
                <div class="col-md-7">
                  <input type="submit" class="btn btn-primary btn-block" value="作成">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

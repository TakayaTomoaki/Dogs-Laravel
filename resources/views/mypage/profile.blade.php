@extends('layouts.profile')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">愛犬プロフィール編集</div>
          <div class="card-body">
            <form action="{{ route('update', ['user_id' => $user_id]) }}" method="post" enctype="multipart/form-data">

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
                           value="{{ $dog_prof->dog_name }}" required autofocus>
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
                           name="dog_birthday" placeholder="日付を選択してください"  required value="{{ $dog_prof->dog_birthday }}">
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
                      <input class="form-check-input ml-2 @error('dog_gender') is-invalid @enderror" type="radio" name="dog_gender" value="0"
                             id="dog_gender" @if($dog_prof->dog_gender === 0) checked @endif>
                      <label class="form-check-label @error('dog_gender') is-invalid @enderror">オス</label>
                      <input class="form-check-input ml-3 @error('dog_gender') is-invalid @enderror" type="radio" name="dog_gender" value="1"
                             @if($dog_prof->dog_gender === 1) checked @endif>
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
                      @for($i=1; $i<=100; $i++)
                        <option value="{{ $i }}" @if($i === $dog_prof->dog_weight) selected @endif>
                          {{ $i }} kg
                        </option>
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

                      @foreach(config('dogbreed.breeds') as $key => $breed)
                        <option value="{{ $key }}" @if($key === $dog_prof->dog_father) selected @endif>
                          {{ $breed }}
                        </option>
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
                      @foreach(config('dogbreed.breeds') as $key => $breed)
                        <option value="{{ $key }}" @if($key === $dog_prof->dog_mother) selected @endif>
                          {{ $breed }}
                        </option>
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
                    <textarea id="dog_introduction" class="form-control @error('dog_introduction') is-invalid @enderror" name="dog_introduction" rows="4" placeholder="・食べているフード　・好きな遊び　・性格　・行きつけのドッグラン　など" required>{{ $dog_prof->dog_introduction }}</textarea>
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
                    <input id="dog_image" type="file" class="form-control-file file" name="dog_image" accept="image/png, image/jpeg" value="{{ $dog_prof->dog_image }}">
                    @if($dog_prof->dog_image !== null)
                    <img src="{{ asset('storage/dog_image/'.$dog_prof->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="150">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                        </label>
                      </div>
                      @endif
                  </div>
                </div>


              <div class="form-group row">
                <div class="col-3">
                  {{ csrf_field() }}
                </div>
                <div class="col-7">
                  <input type="submit" class="btn btn-primary btn-block" value="更新する">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

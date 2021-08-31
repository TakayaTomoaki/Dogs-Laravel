@extends('layouts.profile')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">愛犬プロフィール作成</div>
        <div class="card-body">
          <form action="{{ action('MypageController@create') }}" method="post" enctype="multipart/form-data">

            @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
              @endforeach
            </ul>
            @endif
            <div class="form-group row">
              <label class="col-md-2">愛犬ネーム</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="dog_name">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2">生年月日</label>
              <div class="col-md-8">
                <input type="date" class="form-control" name="dog_age">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2">性別</label>
              <div class="col-md-8">
                <select type="text" class="form-control" name="dog_gender">
                  <option value="0">- 選択してください -</option>

                  @foreach(config('gender.gender') as $key => $gender)
                  <option value="{{ $key }}">{{ $gender }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2">体重</label>
              <div class="col-md-8">
                <select type="text" class="form-control" name="dog_weight">
                  <option value="unknown">- 選択してください -</option>
                  @for($i=1; $i<=100; $i++){ echo <option value='{{ $i }}'>{{ $i }} kg</option>
                    }
                    @endfor
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2">父犬種</label>
              <div class="col-md-8">
                <select type="text" class="form-control" name="dog_father">
                  <option value="0">- 選択してください -</option>

                  @foreach(config('dogbreed.breeds') as $key => $breed)
                  <option value="{{ $key }}">{{ $breed }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2">母犬種</label>
              <div class="col-md-8">
                <select type="text" class="form-control" name="dog_mother">
                  <option value="0">- 選択してください -</option>
                  @foreach(config('dogbreed.breeds') as $key => $breed)
                  <option value="{{ $key }}">{{ $breed }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-2">愛犬紹介欄</label>
              <div class="col-md-8">
                <textarea class="form-control" name="dog_introduction" rows="20"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-2" for="title">画像</label>
              <div class="col-md-8">
                <input type="file" class="form-control-file" name="dog_image">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-8">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="作成">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

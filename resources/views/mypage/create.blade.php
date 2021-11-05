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
                        <form action="{{ action('MypageController@store') }}" method="post"
                              enctype="multipart/form-data">

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
                                    <input type="text" id="datepicker" placeholder="日付を選択してください"
                                           name="dog_birthday">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-2">性別</label>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2" type="radio"
                                               name="dog_gender" value="0">
                                        <label class="form-check-label">オス</label>
                                        <input class="form-check-input ml-3" type="radio"
                                               name="dog_gender" value="1">
                                        <label class="form-check-label">メス</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2">体重</label>
                                <div class="col-md-8">
                                    <select type="text" class="form-control" name="dog_weight">
                                        <option value="unknown">- 選択してください -</option>
                                        @for($i=1; $i<=100; $i++){ echo
                                        <option value='{{ $i }}'>{{ $i }} kg</option>
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
                                    <textarea class="form-control" name="dog_introduction"
                                              rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2" for="title">画像</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file" name="dog_image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
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

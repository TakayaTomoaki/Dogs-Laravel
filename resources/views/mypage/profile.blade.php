@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">愛犬プロフィール編集</div>
                    <div class="card-body">
                        <form action="{{ action('MypageController@update', ['user_id' => $user_id]) }}"
                              method="post" enctype="multipart/form-data">

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
                                    <input type="text" class="form-control" name="dog_name"
                                           value="{{ $dog_prof->dog_name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2">生年月日</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" name="dog_birthday"
                                           value="{{ $dog_prof->dog_birthday }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">性別</label>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input ml-2" type="radio"
                                               name="dog_gender" value="0"
                                               @if($dog_gender === 0) checked @endif>
                                        <label class="form-check-label">オス</label>
                                        <input class="form-check-input ml-3" type="radio"
                                               name="dog_gender" value="1"
                                               @if($dog_gender === 1) checked @endif >
                                        <label class="form-check-label">メス</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">体重</label>
                                <div class="col-md-8">
                                    <select type="text" class="form-control" name="dog_weight">
                                        @for( $i = 1; $i <= 100; $i++) {
                                        <option value="{{ $i }}"
                                                @if($i === $dog_prof->dog_weight) selected @endif>{{ $i }}
                                            kg
                                        </option>
                                        }
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">父犬種</label>
                                <div class="col-md-8">
                                    <select type="text" class="form-control" name="dog_father">
                                        @foreach ( config( 'dogbreed.breeds' ) as $key=>$breed )
                                            <option value="{{ $key }}"
                                                    @if($key === $dog_prof->dog_father) selected @endif>{{ $breed }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">母犬種</label>
                                <div class="col-md-8">
                                    <select type="text" class="form-control" name="dog_mother">
                                        @foreach ( config( 'dogbreed.breeds' ) as $key=>$breed )
                                            <option value="{{ $key }}"
                                                    @if($key === $dog_prof->dog_mother) selected @endif>{{ $breed }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2">愛犬紹介欄</label>
                                <div class="col-md-8">
                                <textarea class="form-control" name="dog_introduction">
                                    {{ $dog_prof->dog_introduction }}
                                </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2" for="title">画像</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control-file" name="dog_image">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input"
                                                   name="remove" value="true">画像を削除
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input type="hidden" name="id" value="{{ $dog_prof->id }}">
                                    <input type="hidden" name="user_id"
                                           value="{{ $dog_prof->user_id }}">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-primary" value="更新">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

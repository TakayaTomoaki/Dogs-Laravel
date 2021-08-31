@extends('layouts.profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">愛犬プロフィール編集
                </div>
                <div class="card-body">
                    <form action="{{ action('MypageController@update', ['id' => $is_dog]) }}" method="post"
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
                                <input type="text" class="form-control" name="dog_name" value="{{ $is_dog->dog_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2">生年月日</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="dog_age" value="{{ $is_dog->dog_age }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">性別</label>
                            <div class="col-md-8">
                                <select type="text" class="form-control" name="dog_gender">
                                    <option value="{{ $is_dog->dog_gender }}">
                                        {{ config('gender.gender')[$is_dog->dog_gender] }}
                                    </option>
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
                                    <option value="{{ $is_dog->dog_weight }}">{{ $is_dog->dog_weight }} kg</option>
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
                                    <option value="{{ $is_dog->dog_father }}">
                                        {{ config('dogbreed.breeds')[$is_dog->dog_father] }}
                                    </option>

                                    @foreach(config('dogbreed.breeds') as $key => $breed)
                                    <option value="{{ $key }}">{{ $breed }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">母犬種</label>
                            <div class="col-md-8">
                                <select type="text" class="form-control" name="dog_mother"
                                    value="{{ $is_dog->dog_mother }}">
                                    <option value="{{ $is_dog->dog_mother }}">
                                        {{ config('dogbreed.breeds')[$is_dog->dog_mother] }}
                                    </option>
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
                                    rows="20">{{ $is_dog->dog_introduction }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2" for="title">画像</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control-file" name="dog_image">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="hidden" name="id" value="{{ $is_dog->id }}">
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
</div>
@endsection

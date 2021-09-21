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
                        <ul>
                            @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-2">ユーザーネーム</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" value="{{ $user_form->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">居住地</label>
                            <div class="col-md-8">
                                <select type="text" class="form-control" name="location">
                                    @foreach(config('prefecture.prefs') as $index => $location)
                                    <option value="{{ $index }}" @if($user_form->location==$index) selected @endif>
                                        {{ $location }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">メールアドレス</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" value="{{ $user_form->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">パスワード</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password"
                                    value="{{ $user_form->password }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="hidden" name="id" value="{{ $user_form->id }}">
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

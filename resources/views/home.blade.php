@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">ホーム</div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ action('HomeController@store') }}" method="post"
                              enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-md-2">シェア</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="body"
                                           value="{{ old('body') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">画像</label>
                                <div class="d-flex">
                                    <div class="col-md-8">
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="justify-content-end">
                                        <input type="submit" class="btn btn-primary" value="シェアする">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card m-b-md">
                    <div class="card-header">シェア一覧</div>
                    <div class="card-body">
                        <div class="links">
                            <a href="{{ route( 'home') }}">ホーム</a><br>
                            <a href="{{ route( 'mypage', ['user_id' => $user_id]) }}">マイページ</a><br>
                            <a href="{{ route( 'search') }}">検索</a><br>
                            <a href="{{ route( 'notice', ['user_id' => $user_id]) }}">通知</a><br>
                            <a href="{{ route( 'messages', ['user_id' => $user_id]) }}">メッセージ</a><br>
                            <a href="{{ route( 'setup', ['user_id' => $user_id]) }}">設定</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

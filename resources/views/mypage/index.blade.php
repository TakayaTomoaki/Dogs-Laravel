@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                プロフィール
                            </div>
                            @if($user_id == Auth::id())
                                <div class="btn btn-primary btn-sm">
                                    <a href="{{ route('edit', ['user_id'=> $user_id]) }}"
                                       class="btn-primary">プロフィール変更</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">愛犬ネーム ： {{ $dog_prof->dog_name }}</div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">年齢：
                                {{ $dog_age }} 歳
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">性別 ：
                                {{ $dog_gender }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">体重 ：
                                {{ $dog_prof->dog_weight }} kg
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">父犬種 ：
                                {{ config('dogbreed.breeds')[$dog_prof->dog_father] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">母犬種 ：
                                {{ config('dogbreed.breeds')[$dog_prof->dog_mother] }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">愛犬紹介欄 ：
                                {!!  nl2br($dog_prof->dog_introduction) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-md">
                    <div class="card-header">シェア一覧</div>
                    @if(!empty($shares))
                        @foreach($shares as $share)
                            {{--                            @if ($share->user_id !== $user_id)--}}
                            <a href="{{ route('comment', ['id' => $share->id]) }}"
                               class="list-group-item list-group-item-action">
                                <div class="card-body">
                                    <div class="mh-100 w-25 float-left">
                                        <svg class="bd-placeholder-img mr-3 rounded" width="60"
                                             height="60" xmlns="http://www.w3.org/2000/svg"
                                             preserveAspectRatio="xMidYMid slice"
                                             focusable="false" role="img"
                                             aria-label="Generic placeholder image">
                                            <title>Generic placeholder image</title>
                                            <rect width="100%" height="100%" fill="#868e96"/>
                                        </svg>
                                    </div>
                                    <div class="row w-75">
                                        {{ $share->body }}
                                    </div>
                                </div>
                            </a>
                            <div class="card-footer d-flex bg-white">
                                <div class="ml-5 mr-5 d-flex align-items-center">
                                    <a href="#">
                                        <i class="far fa-star"></i></a>
                                    <p class="mb-0 text-secondary">#</p>
                                </div>
                                <div class="ml-5 mr-5 d-flex align-items-center">
                                    <a href="#"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">#</p>
                                </div>
                            </div>
                            {{--                            @endif--}}
                        @endforeach
                    @endif
                    {{--                    @if($shares !== null)--}}
                    {{--                        {{ $shares->links() }}--}}
                    {{--                    @endif--}}
                </div>
                <div class="card m-b-md">
                    <div class="card-header">いいね一覧</div>
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
    </div>
@endsection

@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                コメント一覧
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex ">
                        <div class=" mr-3">
                            <svg class="bd-placeholder-img mr-3 rounded" width="50"
                                 height="50" xmlns="http://www.w3.org/2000/svg"
                                 preserveAspectRatio="xMidYMid slice"
                                 focusable="false"
                                 role="img" aria-label="Generic placeholder image">
                                <title>Generic placeholder image</title>
                                <rect width="100%" height="100%" fill="#868e96"/>
                            </svg>
                        </div>
                        <div class="row">
                            <div class="font-weight-bold mr-3">
                                <a href="{{ route('mypage', ['user_id'=>$dog['user_id']])}}">
                                    {{ $dog->dog_name }}
                                    @if($dog->dog_gender === 0) くん@endif
                                    @if($dog->dog_gender === 1) ちゃん@endif
                                </a>
                            </div>
                            <p>{{ date('n月j日', strtotime($dog->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                {!!  nl2br($share['body']) !!}
                            </div>
                        </div>
                        <div class="card-footer d-flex bg-white">
                            <div class="ml-5 mr-5 d-flex align-items-center">
                                <a href="#"><i class="far fa-star"></i></a>
                                <p class="mb-0 text-secondary">#</p>
                            </div>
                            <div class="ml-5 mr-5 d-flex align-items-center">
                                <a href="#"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">#</p>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <form action="{{ action('CommentController@store', ['id' => $share['id']]) }}"
                                  method="post" enctype="multipart/form-data">
                                <div class="d-flex form-group">
                                    <input type="text" class="form-control" name="comment"
                                           placeholder="コメントを投稿" value="{{ old('comment') }}">
                                    <div class="ml-3 d-flex justify-content-end">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-primary btn-sm"
                                               value="コメント">
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($comments !== null)
                            @foreach($comments as $comment)
                                <div class="card-footer bg-white">
                                    <div class="mh-100 float-left">
                                        <svg class="bd-placeholder-img mr-3 rounded" width="50"
                                             height="50" xmlns="http://www.w3.org/2000/svg"
                                             preserveAspectRatio="xMidYMid slice"
                                             focusable="false"
                                             role="img" aria-label="Generic placeholder image">
                                            <title>Generic placeholder image</title>
                                            <rect width="100%" height="100%" fill="#868e96"/>
                                        </svg>
                                    </div>
                                    {{--                                <form action="{{ action('CommentController@store', ['id' => $share['id']]) }}"--}}
                                    {{--                                      method="post" enctype="multipart/form-data">--}}
                                    <div class="row">
                                        <div class="d-flex mr-4">
                                            <a href="{{ route('mypage', ['user_id' => $comment->user_id])}}">
                                                {{ $comment->dog_name }}
                                                @if($comment->dog_gender === 0) くん@endif
                                                @if($comment->dog_gender === 1) ちゃん@endif
                                            </a>
                                        </div>
                                        <div class="d-flex">{{ date('n月j日', strtotime($comment->created_at)) }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="w-100">{{ $comment->comment }}</div>
                                        {{--                                </form>--}}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

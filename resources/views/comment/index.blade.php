@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs">
                <div class="card m-b-md">
                    <div class="card-header">
                        コメント一覧
                    </div>
                    {{--投稿の表示--}}
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-2">
                                <svg class="bd-placeholder-img rounded" width="60"
                                     height="60" xmlns="http://www.w3.org/2000/svg"
                                     preserveAspectRatio="xMidYMid slice"
                                     focusable="false"
                                     role="img" aria-label="Generic placeholder image">
                                    <title>Generic placeholder image</title>
                                    <rect width="100%" height="100%" fill="#868e96"/>
                                </svg>
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col d-flex">
                                        <div class="font-weight-bold">
                                            <a href="{{ route('mypage', ['user_id'=>$dog['user_id']])}}">
                                                <p class="mb-0">{{ $dog->dog_name }}
                                                    {{ nameTitle($dog->dog_gender) }}</p>
                                            </a>
                                        </div>
                                        <p class="mb-0 ml-3">{{ date('n月j日', strtotime($shares[0]->created_at)) }}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col">
                                        {!!  nl2br($shares[0]->body) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-0">
                        {{--いいねユーザーの一覧表示--}}
                        @if($shares[0]->nice !== 0)
                            <a href="{{ route('nicer', ['user_id' => $shares[0]->id]) }}">
                                <p class="my-1 ml-2 text-secondary">{{ $shares[0]->nice }} 件のいいね</p>
                            </a>
                        @endif
                        @if($shares[0]->nice === 0)
                            <p class="my-1 ml-2 text-secondary">{{ $shares[0]->nice }} 件のいいね</p>
                        @endif
                        <div class="card-footer d-flex px-0 py-1 bg-white">
                            {{--いいねアイコン--}}
                            <div class="col py-0 d-flex align-items-center justify-content-center">
                                @if($shares[0]->count === 0)
                                    <object>
                                        <form method="post"
                                              action="{{ route('nice') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id"
                                                   value="{{ $shares[0]->id }}">
                                            <button type="submit"
                                                    class="btn p-0 border-0 text-primary rounded-circle">
                                                <i class="fas fa-paw fa-fw"
                                                   style="color:silver"></i>
                                            </button>
                                        </form>
                                    </object>
                                    <p class="mb-0 ml-2 text-secondary">{{ $shares[0]->nice }}</p>
                                @endif
                                @if($shares[0]->count === 1)
                                    <object>
                                        <form method="post"
                                              action="{{ route('unlock') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id"
                                                   value="{{ $shares[0]->id }}">
                                            <button type="submit"
                                                    class="btn p-0 border-0 text-primary rounded-circle">
                                                <i class="fas fa-paw fa-fw" style="color:red"></i>
                                            </button>
                                        </form>
                                    </object>
                                    <p class="mb-0 ml-2 text-secondary">{{ $shares[0]->nice }}</p>
                                @endif
                            </div>
                            {{--コメントアイコン--}}
                            <div class="col d-flex align-items-center text-primary justify-content-center">
                                <i class="far fa-comment fa-fw"></i>
                                <p class="mb-0 ml-2 text-secondary">{{ $shares[0]->comment }}</p>
                            </div>
                            {{--削除アイコン--}}
                            <div class="col d-flex align-items-center text-primary justify-content-center">
                                @if($shares[0]->user_id === Auth::id())
                                    <div class="dropdown mr-3 d-flex align-items-center">
                                        <object>
                                            <a role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fas fa-tools fa-fw"
                                                   style="color:#007bff"></i>
                                            </a>
                                            <div class="dropdown-menu"
                                                 aria-labelledby="dropdownMenuLink">
                                                <form method="POST"
                                                      action="{{ route('share_delete', ['user_id' => $user_id]) }}"
                                                      class="mb-0">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id"
                                                           value="{{ $shares[0]->id }}">
                                                    <button type="submit"
                                                            class="dropdown-item btn">
                                                        削除
                                                    </button>
                                                </form>
                                            </div>
                                        </object>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{--コメント投稿欄--}}
                        <div class="card-footer bg-white">
                            <form action="{{ action('CommentController@store', ['id' => $shares[0]->id]) }}"
                                  method="post" enctype="multipart/form-data">
                                <div class="d-flex form-group">
                                    <input type="text" class="form-control" name="comment"
                                           placeholder="コメントを投稿" value="{{ old('comment') }}">
                                    <div class="ml-3 d-flex justify-content-end">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-primary btn-sm"
                                               value="投稿">
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{--コメントの表示--}}
                        @if ($comments !== null)
                            @foreach($comments as $comment)
                                <div class="card-footer bg-white">
                                    <div class="row g-0">
                                        <div class="col-2">
                                            <svg class="bd-placeholder-img mr-3 rounded"
                                                 width="50"
                                                 height="50" xmlns="http://www.w3.org/2000/svg"
                                                 preserveAspectRatio="xMidYMid slice"
                                                 focusable="false"
                                                 role="img"
                                                 aria-label="Generic placeholder image">
                                                <title>Generic placeholder image</title>
                                                <rect width="100%" height="100%"
                                                      fill="#868e96"/>
                                            </svg>
                                        </div>
                                        {{--                                <form action="{{ action('CommentController@store', ['id' => $shares[0]->id]) }}"--}}
                                        {{--                                      method="post" enctype="multipart/form-data">--}}
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col d-flex">
                                                    <div class="font-weight-bold">
                                                        <a href="{{ route('mypage', ['user_id' => $comment->user_id])}}">
                                                            {{ $comment->dog_name }}
                                                            {{ nameTitle($comment->dog_gender) }}
                                                        </a>
                                                    </div>
                                                    <p class="mb-0 ml-3">{{ date('n月j日', strtotime($comment->created_at)) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">{{ $comment->comment }}</div>
                                                {{--                                </form>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection

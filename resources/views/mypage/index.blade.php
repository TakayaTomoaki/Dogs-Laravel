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
                            {{--ユーザー情報によりボタン表示を変更--}}
                            @if($user_id === (string)Auth::id())
                                <div class="btn btn-secondary btn-sm">
                                    <a href="{{ route('edit', ['user_id'=> $user_id]) }}"
                                       class="btn-secondary">プロフィール変更</a>
                                </div>
                            @endif

                            @if($user_id !== (string)Auth::id())
                                @if($dog_prof[0]->follow === 0)
                                    <div class="d-flex justify-content-end ">
                                        <form method="post"
                                              action="{{ route('follow', ['user_id' => $user_id]) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id"
                                                   value="{{ $user_id }}">
                                            <button class="btn btn-primary btn-sm rounded-pill"
                                                    type="submit">フォローする
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                @if($dog_prof[0]->follow === 1)
                                    <div class="d-flex justify-content-end ">
                                        <form method="post"
                                              action="{{ route('unfollow', ['user_id' => $user_id]) }}">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="id"
                                                   value="{{ $user_id }}">
                                            <button class="btn btn-danger btn-sm rounded-pill"
                                                    type="submit">フォロー解除
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    {{--プロフィール情報の表示--}}
                    <div class="card-body">
                        <div class="row d-flex">
                            <div class="col">愛犬ネーム ： {{ $dog_prof[0]->dog_name }}</div>
                            @if($user_id !== (string)Auth::id())
                                @if($dog_prof[0]->follower === 1)
                                    <div class="d-flex justify-content-end align-self-start">
                                        <h5 class="text-light mb-0"><span class="badge bg-success">フォローされています</span>
                                        </h5>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="row">
                            <div class="col">年齢：{{ $dog_age }} 歳</div>
                        </div>
                        <div class="row">
                            <div class="col">性別 ：{{ $dog_gender }}</div>
                        </div>
                        <div class="row">
                            <div class="col">体重 ：{{ $dog_prof[0]->dog_weight }} kg</div>
                        </div>
                        <div class="row">
                            <div class="col">父犬種 ：{{ $dog_prof[0]->dog_daddy }}</div>
                        </div>
                        <div class="row">
                            <div class="col">母犬種 ：{{ $dog_prof[0]->dog_mommy }}</div>
                        </div>
                        <div class="row">
                            <div class="col">愛犬紹介
                                ：{!!  nl2br($dog_prof[0]->dog_introduction) !!}</div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="row d-flex">
                            <a href="{{ route('follower', ['user_id' => $user_id]) }}"><p
                                        class="mb-0 ml-3">{{ $dog_prof[0]->countFollow }} フォロー中</p>
                            </a>
                            <a href="{{ route('receiver', ['user_id' => $user_id]) }}"><p
                                        class="mb-0 ml-5">{{ $dog_prof[0]->countReceive }} フォロワー</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <nav>
                        <div class="nav nav-pills" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active col text-sm-center"
                               id="nav-shares-tab"
                               data-toggle="tab"
                               href="#nav-shares" role="tab" aria-controls="nav-shares"
                               aria-selected="true">投稿一覧</a>
                            <a class="nav-item nav-link col text-sm-center" id="nav-comments-tab"
                               data-toggle="tab"
                               href="#nav-comments" role="tab" aria-controls="nav-comments"
                               aria-selected="false">コメント</a>
                            <a class="nav-item nav-link col text-sm-center" id="nav-nices-tab"
                               data-toggle="tab"
                               href="#nav-nices" role="tab" aria-controls="nav-nices"
                               aria-selected="false">いいね</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        {{--投稿一覧タブ--}}
                        <div class="tab-pane fade show active" id="nav-shares" role="tabpanel"
                             aria-labelledby="nav-home-tab">

                            @if(!empty($shares))
                                @foreach($shares as $share)
                                    <a href="{{ route('comment', ['id' => $share->id]) }}"
                                       class="list-group-item list-group-item-action">
                                        <div class="card-body px-0 pt-1 pb-0">
                                            <div class="row g-0">
                                                <div class="col-2">
                                                    <svg class="bd-placeholder-img rounded"
                                                         width="60"
                                                         height="60"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         preserveAspectRatio="xMidYMid slice"
                                                         focusable="false" role="img"
                                                         aria-label="Generic placeholder image">
                                                        <title>image</title>
                                                        <rect width="100%" height="100%"
                                                              fill="#868e96"/>
                                                    </svg>
                                                </div>
                                                <div class="col-10">
                                                    <div class="row mb-0 pl-1">
                                                        <div class="col">
                                                            {{ date('n月j日', strtotime($share->created_at)) }}
                                                        </div>
                                                    </div>
                                                    <div class="row pl-1 form-group">
                                                        <div class="col">
                                                            {!!  nl2br($share->body) !!}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    {{--アイコン表示--}}
                                                    <div class="row d-flex pl-1">
                                                        {{--いいねアイコン表示--}}
                                                        <div class="col-4 d-flex align-items-center">
                                                            @if($share->count === 0)
                                                                <object>
                                                                    <form method="post"
                                                                          action="{{ route('nice') }}">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden"
                                                                               name="id"
                                                                               value="{{ $share->id }}">
                                                                        <button type="submit"
                                                                                class="btn p-0 border-0 text-primary rounded-circle">
                                                                            <i class="fas fa-paw fa-fw"
                                                                               style="color:silver"></i>
                                                                        </button>
                                                                    </form>
                                                                </object>
                                                                <p class="mb-0 ml-2 text-secondary">{{ $share->nice }}</p>
                                                            @endif
                                                            @if($share->count === 1)
                                                                <object>
                                                                    <form method="post"
                                                                          action="{{ route('unlock') }}">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden"
                                                                               name="id"
                                                                               value="{{ $share->id }}">
                                                                        <button type="submit"
                                                                                class="btn p-0 border-0 text-primary rounded-circle">
                                                                            <i class="fas fa-paw fa-fw"
                                                                               style="color:red"></i>
                                                                        </button>
                                                                    </form>
                                                                </object>
                                                                <p class="mb-0 ml-2 text-secondary">{{ $share->nice }}</p>
                                                            @endif
                                                        </div>
                                                        {{--コメントアイコン表示--}}
                                                        <div class="col-4 d-flex align-items-center text-primary">
                                                            <object>
                                                                <a href="{{ route('comment', ['id' => $share->id]) }}">
                                                                    <i class="far fa-comment fa-fw"></i></a>
                                                            </object>
                                                            <p class="mb-0 ml-2 text-secondary">{{ $share->comment }}</p>
                                                        </div>
                                                        {{--削除アイコン表示--}}
                                                        @if($user_id === (string)Auth::id())
                                                            <div class="dropdown col-4 d-flex align-items-center">
                                                                <object>
                                                                    <a role="button"
                                                                       id="dropdownMenuLink"
                                                                       data-toggle="dropdown"
                                                                       aria-haspopup="true"
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
                                                                            <input type="hidden"
                                                                                   name="id"
                                                                                   value="{{ $share->id }}">
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
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                            {{--                    @if($shares !== null)--}}
                            {{--                        {{ $shares->links() }}--}}
                            {{--                    @endif--}}
                        </div>
                        {{--コメント一覧タブ--}}
                        <div class="tab-pane fade" id="nav-comments" role="tabpanel"
                             aria-labelledby="nav-profile-tab">

                            @if(!empty($comments))
                                @foreach($comments as $comment)
                                    <a href="{{ route('comment', ['id' => $comment->id]) }}"
                                       class="list-group-item list-group-item-action">
                                        <div class="card-body  px-0 pt-1 pb-0">
                                            <div class="row g-0">
                                                <div class="col-2">
                                                    <svg class="bd-placeholder-img rounded"
                                                         width="60"
                                                         height="60"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         preserveAspectRatio="xMidYMid slice"
                                                         focusable="false" role="img"
                                                         aria-label="Generic placeholder image">
                                                        <title>image</title>
                                                        <rect width="100%" height="100%"
                                                              fill="#868e96"/>
                                                    </svg>
                                                </div>
                                                <div class="col-10">
                                                    <div class="row pl-1">
                                                        <div class="col d-flex">
                                                            <object>
                                                                <a href="{{ route('mypage', ['user_id' => $comment->user_id])}}">
                                                                    <p class="mb-0 mr-3">{{ $comment->dog_name }}
                                                                        {{ nameTitle($comment->dog_gender) }}</p>
                                                                </a>
                                                            </object>
                                                            <p class="ml-3 mb-0">{{ date('n月j日', strtotime($comment->created_at)) }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row pl-1 form-group">
                                                        <div class="col">
                                                            {!!  nl2br($comment->body) !!}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row d-flex pl-1">
                                                        <div class="col-4 d-flex align-items-center">
                                                            @if($comment->count === 0)
                                                                <object>
                                                                    <form method="post"
                                                                          action="{{ route('nice') }}">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden"
                                                                               name="id"
                                                                               value="{{ $comment->id }}">
                                                                        <button type="submit"
                                                                                class="btn p-0 border-0 text-primary rounded-circle">
                                                                            <i class="fas fa-paw fa-fw"
                                                                               style="color:silver"></i>
                                                                        </button>
                                                                    </form>
                                                                </object>
                                                                <p class="mb-0 ml-2 text-secondary">{{ $comment->nice }}</p>
                                                            @endif
                                                            @if($comment->count === 1)
                                                                <object>
                                                                    <form method="post"
                                                                          action="{{ route('unlock') }}">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden"
                                                                               name="id"
                                                                               value="{{ $comment->id }}">
                                                                        <button type="submit"
                                                                                class="btn p-0 border-0 text-primary rounded-circle">
                                                                            <i class="fas fa-paw fa-fw"
                                                                               style="color:red"></i>
                                                                        </button>
                                                                    </form>
                                                                </object>
                                                                <p class="mb-0 ml-2 text-secondary">{{ $comment->nice }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="col-4 d-flex align-items-center text-primary">
                                                            <object>
                                                                <a href="{{ route('comment', ['id' => $comment->id]) }}"><i
                                                                            class="far fa-comment fa-fw"></i></a>
                                                            </object>
                                                            <p class="mb-0 ml-2 text-secondary">{{ $comment->comment }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                            {{--                    @if($shares !== null)--}}
                            {{--                        {{ $shares->links() }}--}}
                            {{--                    @endif--}}
                        </div>
                        {{--いいね一覧タブ--}}
                        <div class="tab-pane fade" id="nav-nices" role="tabpanel"
                             aria-labelledby="nav-contact-tab">

                            @foreach($nices as $nice)
                                <a href="{{ route('comment', ['id' => $nice->share_id]) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="card-body px-0 pt-1 pb-0">
                                        <div class="row g-0">
                                            <div class="col-2">
                                                <svg class="bd-placeholder-img rounded" width="60"
                                                     height="60" xmlns="http://www.w3.org/2000/svg"
                                                     preserveAspectRatio="xMidYMid slice"
                                                     focusable="false" role="img"
                                                     aria-label="Generic placeholder image">
                                                    <title>image</title>
                                                    <rect width="100%" height="100%"
                                                          fill="#868e96"/>
                                                </svg>
                                            </div>
                                            <div class="col-10">
                                                <div class="row pl-1">
                                                    <div class="col d-flex">
                                                        <object>
                                                            <a href="{{ route('mypage', ['user_id' => $nice->your_id])}}">
                                                                <p class="mb-0 mr-3">{{ $nice->dog_name }}
                                                                    {{ nameTitle($nice->dog_gender) }}</p>
                                                            </a>
                                                        </object>
                                                        <p class="mb-0 ml-3">{{ date('n月j日', strtotime($nice->created_at)) }}</p>
                                                    </div>
                                                </div>

                                                <div class="row pl-1 form-group">
                                                    <div class="col">
                                                        {!!  nl2br($nice->body) !!}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row d-flex pl-1">
                                                    <div class="col-4 d-flex align-items-center">
                                                        @if($nice->count === 0)
                                                            <object>
                                                                <form method="post" name="nice"
                                                                      id="nice"
                                                                      action="{{ route('nice') }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id"
                                                                           value="{{ $nice->share_id }}">
                                                                    <button type="submit"
                                                                            class="btn p-0 border-0 text-primary rounded-circle">
                                                                        <i class="fas fa-paw fa-fw"
                                                                           style="color:silver"></i>
                                                                    </button>
                                                                </form>
                                                            </object>
                                                            <p class="mb-0 ml-2 text-secondary">{{ $nice->nice }}</p>
                                                        @endif
                                                        @if($nice->count === 1)
                                                            <object>
                                                                <form method="post" name="unlock"
                                                                      id="unlock"
                                                                      action="{{ route('unlock') }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id"
                                                                           value="{{ $nice->share_id }}">
                                                                    <button type="submit"
                                                                            class="btn p-0 border-0 text-primary rounded-circle">
                                                                        <i class="fas fa-paw fa-fw"
                                                                           style="color:red"></i>
                                                                    </button>
                                                                </form>
                                                            </object>
                                                            <p class="mb-0 ml-2 text-secondary">{{ $nice->nice }}</p>
                                                        @endif
                                                    </div>

                                                    <div class="col-4 d-flex align-items-center">
                                                        <object>
                                                            <a href="{{ route('comment', ['id' => $nice->share_id]) }}"><i
                                                                        class="far fa-comment fa-fw"></i></a>
                                                        </object>
                                                        <p class="mb-0 ml-2 text-secondary">{{ $nice->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

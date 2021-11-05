@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">
                        <div class="p-2 float-left align-self-center">
                            検索</div>
                        <div class="float-right">
                            <form class="form-inline" method="get" action="{{ route( 'search') }}">
                                <input class="form-control mr-sm-2 rounded-pill" name="search"
                                       type="search" placeholder="名前・都道府県・犬種" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0 btn-sm"
                                        type="submit">検索
                                </button>
                            </form>
                        </div>
                    </div>
                    @if(!empty($outputs))
                        @foreach($outputs as $output)
                            @if ($output->user_id !== $user_id)
                                <a href="{{ route('mypage', ['user_id' => $output->user_id]) }}"
                                   class="list-group-item list-group-item-action">

                                    <div class="card-body">
                                        <div class="row g-0">
                                            <div class="col-2">
                                                <svg class="bd-placeholder-img mr-3 rounded"
                                                     width="60"
                                                     height="60" xmlns="http://www.w3.org/2000/svg"
                                                     preserveAspectRatio="xMidYMid slice"
                                                     focusable="false" role="img"
                                                     aria-label="Generic placeholder image"><title>
                                                        Generic placeholder image</title>
                                                    <rect width="100%" height="100%"
                                                          fill="#868e96"/>
                                                </svg>
                                            </div>
                                            <div class="col-10">
                                                <div class="row d-flex">
                                                    <div class="col-7 font-weight-bold">{{ $output->dog_name }}
                                                        {{ nameTitle($output->dog_gender) }}
                                                    </div>
                                                    <div class="col-5">
                                                        @if($output->follow === 0)
                                                            <object>
                                                                <form method="post"
                                                                      action="{{ route('follow', ['user_id' => $user_id]) }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id"
                                                                           value="{{ $output->user_id }}">
                                                                    <button class="btn btn-primary btn-sm rounded-pill"
                                                                            type="submit">フォロー
                                                                    </button>
                                                                </form>
                                                            </object>
                                                        @endif
                                                        @if($output->follow === 1)
                                                            <object>
                                                                <form method="post"
                                                                      action="{{ route('unfollow', ['user_id' => $user_id]) }}">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="id"
                                                                           value="{{ $output->user_id }}">
                                                                    <button class="btn btn-danger btn-sm rounded-pill"
                                                                            type="submit">フォロー解除
                                                                    </button>
                                                                </form>
                                                            </object>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">{{ $output->location }}</div>
                                                    <div class="col">
                                                        {{ age($output->user_id) }}
                                                        歳
                                                    </div>
                                                    <div class="col">
                                                        {{ $output->dog_weight }} kg
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">犬種：
                                                        {{--                                                純血犬とMix犬とで表示を変更--}}
                                                        @if($output->dog_father === $output->dog_mother)
                                                            {{ $output->dog_daddy }}
                                                        @endif
                                                        @if($output->dog_father !== $output->dog_mother)
                                                            {{ $output->dog_daddy }}
                                                            ×
                                                            {{ $output->dog_mommy }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif
                    {{--                    @if($outputs !== null)--}}
                    {{--                        {{ $outputs->links() }}--}}
                    {{--                    @endif--}}


                </div>

                <div class="card m-b-md">
                    <div class="card-header">おすすめユーザー</div>
                    @if (!empty($profiles))
                        @foreach($profiles as $dog_prof)
                            @if ($dog_prof->user_id !== $user_id)
                                <a href="{{ route('mypage', ['user_id' => $dog_prof->user_id]) }}"
                                   class="list-group-item list-group-item-action">

                                    <div class="card-body">
                                        <div class="row g-0">
                                            <div class="col-2">

                                                {{--                                    <img src="{{ $dog_prof->dog_image }}" alt="愛犬画像"--}}
                                                {{--                                         class="bd-placeholder-img mr-3 rounded" width="75" height="75">--}}
                                                <svg class="bd-placeholder-img rounded"
                                                     width="60"
                                                     height="60"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     preserveAspectRatio="xMidYMid slice"
                                                     focusable="false"
                                                     role="img"
                                                     aria-label="Generic placeholder image">
                                                    <title>Generic placeholder image</title>
                                                    <rect width="100%" height="100%"
                                                          fill="#868e96"/>
                                                </svg>
                                            </div>
                                            <div class="col-10">

                                                <div class="row d-flex">
                                                    <div class="col-7 font-weight-bold">{{ $dog_prof->dog_name }}
                                                        {{ nameTitle($dog_prof->dog_gender) }}
                                                    </div>
                                                    <div class="col-5">
                                                        @if($dog_prof->follow === 0)
                                                            <object>
                                                                <form method="post"
                                                                      action="{{ route('follow', ['user_id' => $user_id]) }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id"
                                                                           value="{{ $dog_prof->user_id }}">
                                                                    <button class="btn btn-primary btn-sm rounded-pill"
                                                                            type="submit">フォロー
                                                                    </button>
                                                                </form>
                                                            </object>
                                                        @endif
                                                        @if($dog_prof->follow === 1)
                                                            <object>
                                                                <form method="post"
                                                                      action="{{ route('unfollow', ['user_id' => $user_id]) }}">
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="id"
                                                                           value="{{ $dog_prof->user_id }}">
                                                                    <button class="btn btn-danger btn-sm rounded-pill"
                                                                            type="submit">フォロー解除
                                                                    </button>
                                                                </form>
                                                            </object>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">{{ $dog_prof->location }}</div>
                                                    <div class="col">
                                                        {{ age($dog_prof->dog_birthday) }}
                                                        歳
                                                    </div>
                                                    <div class="col">
                                                        {{ $dog_prof->dog_weight }} kg
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">犬種：
                                                        {{--純血犬とMix犬とで表示を変更--}}
                                                        @if($dog_prof->dog_daddy === $dog_prof->dog_mommy)
                                                            {{ $dog_prof->dog_daddy }}
                                                        @endif
                                                        @if($dog_prof->dog_daddy !== $dog_prof->dog_mommy)
                                                            {{ $dog_prof->dog_daddy }}
                                                            ×
                                                            {{ $dog_prof->dog_mommy }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif
                    {{--                    @if($profiles !== null)--}}
                    {{--                        {{ $profiles->links() }}--}}
                    {{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
@endsection

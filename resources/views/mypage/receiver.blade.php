@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">フォロワー</div>
                    @foreach($receivers as $receiver)
                        <a href="{{ route('mypage', ['user_id' => $receiver->user_id]) }}"
                           class="list-group-item list-group-item-action">

                            <div class="card-body">
                                <div class="row g-0">
                                    <div class="col-2">

                                        {{--                                    <img src="{{ $receiver->dog_image }}" alt="愛犬画像"--}}
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
                                            <div class="col-7 font-weight-bold">{{ $receiver->dog_name }}
                                                {{ nameTitle($receiver->dog_gender) }}
                                            </div>
                                            <div class="col-5">
                                                @if($receiver->user_id !== Auth::id())
                                                    @if($receiver->follow === 0)
                                                        <object>
                                                            <form method="post"
                                                                  action="{{ route('follow', ['user_id' => $user_id]) }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id"
                                                                       value="{{ $receiver->user_id }}">
                                                                <button class="btn btn-primary btn-sm rounded-pill"
                                                                        type="submit">フォロー
                                                                </button>
                                                            </form>
                                                        </object>
                                                    @endif
                                                    @if($receiver->follow === 1)
                                                        <object>
                                                            <form method="post"
                                                                  action="{{ route('unfollow', ['user_id' => $user_id]) }}">
                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="id"
                                                                       value="{{ $receiver->user_id }}">
                                                                <button class="btn btn-danger btn-sm rounded-pill"
                                                                        type="submit">フォロー解除
                                                                </button>
                                                            </form>
                                                        </object>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">{{ $receiver->location }}</div>
                                            <div class="col">
                                                {{ age($receiver->dog_birthday) }}
                                                歳
                                            </div>
                                            <div class="col">
                                                {{ $receiver->dog_weight }} kg
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">犬種：
                                                {{--純血犬とMix犬とで表示を変更--}}
                                                @if($receiver->dog_daddy === $receiver->dog_mommy)
                                                    {{ $receiver->dog_daddy }}
                                                @endif
                                                @if($receiver->dog_daddy !== $receiver->dog_mommy)
                                                    {{ $receiver->dog_daddy }}
                                                    ×
                                                    {{ $receiver->dog_mommy }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    {{--                    @if($profiles !== null)--}}
                    {{--                        {{ $profiles->links() }}--}}
                    {{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
@endsection

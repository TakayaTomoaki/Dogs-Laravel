@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-b-md">
                    <div class="card-header">
                        <div class="p-2 float-left align-self-center">検索</div>
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
                                <a href="{{ route('show', ['user_id' => $output->user_id]) }}"
                                   class="list-group-item list-group-item-action">

                                    <div class="card-body">
                                        <div class="mh-100 w-25 float-left">
                                            <svg class="bd-placeholder-img mr-3 rounded" width="75"
                                                 height="75" xmlns="http://www.w3.org/2000/svg"
                                                 preserveAspectRatio="xMidYMid slice"
                                                 focusable="false" role="img"
                                                 aria-label="Generic placeholder image"><title>
                                                    Generic placeholder image</title>
                                                <rect width="100%" height="100%" fill="#868e96"/>
                                            </svg>
                                        </div>
                                        <div class="row">
                                            <div class="w-75 font-weight-bold">{{ $output->dog_name }}
                                                @if($output->dog_gender === 0) くん@endif
                                                @if($output->dog_gender === 1) ちゃん@endif
                                            </div>
                                            <div class="w-25">
                                                <object>
                                                    <a class="btn btn-primary btn-sm rounded-pill"
                                                       href="{{ route('show', ['user_id' => $output->user_id]) }}">フォロー</a>
                                                </object>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="w-25">{{ config('prefecture.prefs')[$output->location] }}</div>
                                            <div class="w-25">
                                                {{ floor((date("Ymd") - str_replace("-", "", $output->dog_birthday)) / 10000) }}
                                                歳
                                            </div>
                                            <div class="w-25">
                                                {{ $output->dog_weight }} kg
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="w-100">犬種：
                                                {{--                                                純血犬とMix犬とで表示を変更--}}
                                                @if($output->dog_father === $output->dog_mother)
                                                    {{ config('dogbreed.breeds')[$output->dog_father] }}
                                                @endif
                                                @if($output->dog_father !== $output->dog_mother)
                                                    {{ config('dogbreed.breeds')[$output->dog_father] }}
                                                    ×
                                                    {{ config('dogbreed.breeds')[$output->dog_mother] }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif
                    {{ $profiles->links() }}


                </div>

                <div class="card m-b-md">
                    <div class="card-header">おすすめユーザー</div>
                    @foreach($profiles as $dog_prof)
                        @if ($dog_prof->user_id !== $user_id)
                            <a href="{{ route('show', ['user_id' => $dog_prof->user_id]) }}"
                               class="list-group-item list-group-item-action">

                                <div class="card-body">
                                    <div class="mh-100 w-25 float-left">
                                        {{--                                    <img src="{{ $dog_prof->dog_image }}" alt="愛犬画像"--}}
                                        {{--                                         class="bd-placeholder-img mr-3 rounded" width="75" height="75">--}}
                                        <svg class="bd-placeholder-img mr-3 rounded" width="75"
                                             height="75" xmlns="http://www.w3.org/2000/svg"
                                             preserveAspectRatio="xMidYMid slice" focusable="false"
                                             role="img" aria-label="Generic placeholder image">
                                            <title>Generic placeholder image</title>
                                            <rect width="100%" height="100%" fill="#868e96"/>
                                        </svg>
                                    </div>
                                    <div class="row">
                                        <div class="w-75 font-weight-bold">{{ $dog_prof->dog_name }}
                                            @if($dog_prof->dog_gender === 0) くん@endif
                                            @if($dog_prof->dog_gender === 1) ちゃん@endif
                                        </div>
                                        <div class="w-25">
                                            <object><a class="btn btn-primary btn-sm rounded-pill"
                                                       href="{{ route('show', ['user_id' => $dog_prof->user_id]) }}">フォロー</a>
                                            </object>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="w-25">{{ config('prefecture.prefs')[$dog_prof->location] }}</div>
                                        <div class="w-25">
                                            {{ floor((date("Ymd") - str_replace("-", "", $dog_prof->dog_birthday)) / 10000) }}
                                            歳
                                        </div>
                                        <div class="w-25">
                                            {{ $dog_prof->dog_weight }} kg
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="w-100">犬種：
                                            {{--純血犬とMix犬とで表示を変更--}}
                                            @if($dog_prof->dog_father === $dog_prof->dog_mother)
                                                {{ config('dogbreed.breeds')[$dog_prof->dog_father] }}
                                            @endif
                                            @if($dog_prof->dog_father !== $dog_prof->dog_mother)
                                                {{ config('dogbreed.breeds')[$dog_prof->dog_father] }}
                                                ×
                                                {{ config('dogbreed.breeds')[$dog_prof->dog_mother] }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    {{ $profiles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

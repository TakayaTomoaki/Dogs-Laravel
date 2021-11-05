@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs">
                <div class="card m-b-md">
                    <div class="card-header">ホーム
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('share') }}" method="post"
                              enctype="multipart/form-data">
                            <div class="form-group row">
                                <p class="col-2">投稿</p>
                                <div class="form-group row mb-0 col-10">
                                    <textarea
                                            class="form-control @error('text') is-invalid @enderror"
                                            name="body" required autocomplete="text"
                                            rows="4">{{ old('text') }}</textarea>
                                    <div class="text-right">
                                        <p class="text-danger">100文字以内</p>
                                    </div>
                                </div>
                                <p class="col-2">画像</p>
                                <div class="col-10">
                                    <input type="file" class="form-control-file mb-2" name="image">
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-primary btn-sm ">シェアする
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card m-b-md">
                    <div class="card-header">シェア一覧</div>
                    @if(!empty($shares))
                        @foreach($shares as $share)
                            {{--                            @if ($share->user_id !== $user_id)--}}

                            <input type="hidden" id="count" value=0>
                            <div id="content">

                                <a href="{{ route('comment', ['id' => $share->id]) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="card-body px-0 pt-1 pb-0">
                                        <div class="row g-0">
                                            <div class="col-2 ">

                                                <svg class="bd-placeholder-img rounded" width="60"
                                                     height="60" xmlns="http://www.w3.org/2000/svg"
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
                                                <div class="row pl-1">
                                                    <div class="col d-flex">
                                                        <div class="font-weight-bold">
                                                            <object>
                                                                <a href="{{ route('mypage', ['user_id'=>$share->user_id])}}">
                                                                    <p class="mb-0">{{ $share->dog_name }}
                                                                        {{ nameTitle($share->dog_gender) }}</p>
                                                                </a>
                                                            </object>
                                                        </div>
                                                        <p class="mb-0 ml-3">{{ date('n月j日', strtotime($share->created_at)) }}</p>
                                                    </div>
                                                </div>
                                                <div class="row pl-1 form-group">
                                                    <div class="col">
                                                        {!!  nl2br($share->body) !!}
                                                    </div>
                                                </div>

                                                <div class="row pl-1 d-flex">
                                                    <div class="col-4 d-flex align-items-center">

                                                        @if($share->count === 0)
                                                            <object>
                                                                <form method="post"
                                                                      action="{{ route('nice') }}">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="id"
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
                                                                    <input type="hidden" name="id"
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
                                                    <div class="col-4 d-flex align-items-center text-primary">
                                                        <i class="far fa-comment fa-fw"></i>
                                                        <p class="mb-0 ml-2 text-secondary">{{ $share->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif

                    {{--                    @if($shares !== null)--}}
                    {{--                        {{ $shares->links() }}--}}
                    {{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
@endsection

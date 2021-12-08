@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card m-b-md">
          <div class="card-header">コメント</div>

          {{--投稿の表示--}}
          <div class="card-body">
            <div class="media">
              @if($dog->dog_image === null)
              <svg class="bd-placeholder-img rounded  mr-3" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
                   preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
                <title>Generic placeholder image</title>
                <rect width="100%" height="100%" fill="#868e96"/>
              </svg>
              @else
                <img src="{{ asset('storage/dog_image/'.$dog->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
              @endif

              <div class="media-body">
                <div class="font-weight-bold mt-0 d-flex">
                  <a href="{{ route('mypage', ['user_id'=>$dog->user_id])}}">
                    {{ $dog->dog_name }}{{ nameTitle($dog->dog_gender) }}
                  </a>
                  <p class="mb-0 ml-3">{{ date('n月j日', strtotime($shares[0]->created_at)) }}</p>
                </div>
                <p class="text-break mb-1" style="white-space:pre-wrap;">{{ $shares[0]->body }}</p>
                @if($shares[0]->image !== null)
                  <img src="{{ asset('storage/image/'.$shares[0]->image) }}" alt="share_image" class="bd-placeholder-img rounded mr-3" width="150">
                @endif
              </div>
            </div>
          </div>

          <div class="card-body py-0">
            <hr class="my-0">
            {{--いいねユーザーの一覧表示--}}
            <a href="@if($shares[0]->nice !== 0){{ route('nicer', ['user_id' => $shares[0]->id]) }}@endif">
              <p class="my-1 ml-2 text-secondary">{{ $shares[0]->nice }} 件のいいね</p>
            </a>
          </div>

          <div class="card-body py-0">
            <hr class="my-0">

            {{--いいねアイコン--}}
            <div class="col d-flex py-1">
              <div class="col py-0 d-flex align-items-center justify-content-center">
                <object>
                  <form method="get" action="@if($shares[0]->count === 0){{ route('nice') }}@else{{ route('unlock') }}@endif">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $shares[0]->id }}">
                    <button type="submit" class="btn p-0 border-0 text-primary rounded-circle">
                      @if($shares[0]->count === 0)
                        <i class="fas fa-paw fa-fw" style="color:silver"></i>
                      @else
                        <i class="fas fa-paw fa-fw" style="color:red"></i>
                      @endif
                    </button>
                  </form>
                </object>
                <p class="mb-0 ml-2 text-secondary">{{ $shares[0]->nice }}</p>
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
                      <a role="button" class ="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">　
                        <i class="fas fa-tools fa-fw" style="color:#007bff"></i>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form method="POST" action="{{ route('share_delete', ['user_id' => $user_id]) }}">
                          {{ csrf_field() }}
                          <input type="hidden" name="id" value="{{ $shares[0]->id }}">
                          <button type="submit" class="dropdown-item btn">
                            削除する
                          </button>
                        </form>
                      </div>
                    </object>
                  </div>
                @endif
              </div>

            </div>
          </div>
          {{--コメント投稿欄--}}
          <hr class="my-0">
          <div class="card-body d-flex">

            <div class="media align-items-center">
              @if($user->dog_image === null)
              <svg class="bd-placeholder-img mr-4 rounded" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
                   preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
                <title>Generic placeholder image</title>
                <rect width="100%" height="100%" fill="#868e96"/>
              </svg>
              @else
                <img src="{{ asset('storage/dog_image/'.$user->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
              @endif

              <div class="media-body mr-0">
                <form action="{{ route('comment_store', ['id' => $shares[0]->id]) }}" method="post" enctype="multipart/form-data" class="form-row">
                  <div class="input-group">
                    <textarea class="form-control @error('text') is-invalid @enderror" name="comment" required autocomplete="text" rows="2" cols="100" maxlength="100" aria-describedby="buttonAddon" placeholder="コメント入力">{{ old('text') }}</textarea>

                    <div class="ml-2 input-group-append align-self-end">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-primary rounded-pill">投稿</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{--コメントの表示--}}
          @if ($comments !== null)
            @foreach($comments as $comment)
              <hr class="my-0">
              <div class="card-body py-3">

                <div class="media">

                  @if($comment->dog_image === null)
                  <svg class="bd-placeholder-img mr-3 rounded" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
                       preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
                    <title>Generic placeholder image</title>
                    <rect width="100%" height="100%" fill="#868e96"/>
                  </svg>
                  @else
                    <img src="{{ asset('storage/dog_image/'.$comment->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
                  @endif

                  <div class="media-body">
                    <div class="col d-flex pl-0">
                      <div class="font-weight-bold mt-0">

                        <a href="{{ route('mypage', ['user_id' => $comment->user_id])}}">
                          {{ $comment->dog_name }}{{ nameTitle($comment->dog_gender) }}
                        </a>
                      </div>
                      <div class="mb-0 ml-3 small">
                        {{ date('n月j日', strtotime($comment->created_at)) }}
                      </div>
                    </div>
                    <div class="col d-flex px-0">
                      <p class="mb-1 text-break" style="white-space:pre-wrap;">{{ $comment->comment }}</p>
                    </div>

                    <div class="col d-flex pl-0">
                      {{-- いいねアイコン --}}
                      <div class="col-4 d-flex align-items-center justify-content-center">
                        <form method="post" action="@if($comment->count === 0){{ route('like')}}@else{{ route('unlike') }}@endif">
                          <input type="hidden" name="id" value="{{ $comment->id }}">
                          {{ csrf_field() }}
                          <button type="submit" class="btn p-0 border-0 text-primary rounded-circle">
                            @if($comment->count === 0)
                              <i class="fas fa-paw fa-fw" style="color:silver"></i>
                            @else
                              <i class="fas fa-paw fa-fw" style="color:red"></i>
                            @endif
                          </button>
                        </form>
                        <p class="mb-0 ml-2 text-secondary">{{ $comment->likeCount }}</p>
                      </div>

                      {{-- コメントアイコン --}}
                      <div class="col-4 d-flex align-items-center text-primary justify-content-center"></div>

                      {{-- 削除アイコン --}}
                      <div class="dropdown col-4 d-flex align-items-center justify-content-center">
                        @if($comment->user_id === Auth::id())
                          <a role="button" class ="dropdownMenuLink" data-toggle="dropdown"
                             aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-tools fa-fw" style="color:#007bff"></i>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <form method="post" class="mb-0" enctype="multipart/form-data" action="{{ route('comment_delete', ['id'=>$user_id]) }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value="{{ $comment->id }}">
                              <button type="submit" class="dropdown-item btn">削除</button>
                            </form>
                          </div>
                        @endif
                      </div>
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

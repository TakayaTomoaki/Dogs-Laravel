@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card m-b-md">
          <div class="card-header">
            @if($user_id === (string)Auth::id())
              マイページ
            @else
              プロフィール
            @endif
          </div>
          {{--プロフィール情報の表示--}}

          <div class="card-body pb-2 pl-2">
            <div class="media d-flex">
              @if($dog_prof[0]->dog_image === null)
                <div class="fa-stack d-flex" style="font-size:34.3px; margin:0 3.14px">
                  <i class="fas fa-square fa-stack-2x" style="color:@if($dog_prof[0]->dog_gender === 0)deepskyblue @else hotpink @endif"></i>
                  <i class="fas fa-dog fa-stack-1x fa-inverse fa-lg" style="color:white"></i>
                </div>
              @else
                <div class="pl-3 pr-2">
                  <img src="{{ asset('storage/dog_image/'.$dog_prof[0]->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-2" width="60" height="60">
                </div>
              @endif
              {{--ユーザー情報によりボタン表示を変更--}}
              <div class="media-body">
                <div class="row align-items-center pt-1">
                  <div class="font-weight-bold col h6 text-dark pt-2">
                    {{ $dog_prof[0]->dog_name }} {{ nameTitle($dog_prof[0]->dog_gender) }}
                  </div>
                  <div class="justify-content-end">
                    @if($user_id === (string)Auth::id())
                      <div class="btn btn-outline-secondary btn-sm rounded-pill">
                        <a href="{{ route('edit', ['user_id'=> $user_id]) }}" class="btn-outline-secondary">
                          プロフィール変更
                        </a>
                      </div>
                    @else
                      <div class="justify-content-end">
                        <form method="post"
                              action="@if($dog_prof[0]->follow === 0){{ route('follow', ['user_id' => $user_id]) }}
                              @else{{ route('unfollow', ['user_id' => $user_id]) }}@endif">
                          {{ csrf_field() }}
                          <input type="hidden" name="id" value="{{ $user_id }}">
                          @if($dog_prof[0]->follow === 0)
                            <button class="btn btn-primary btn-sm rounded-pill" type="submit">
                              フォローする
                            </button>
                          @else
                            <button class="btn btn-danger btn-sm rounded-pill" type="submit">
                              フォロー解除
                            </button>
                          @endif
                        </form>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col ml-3">
                    <i class="fas fa-map-marker-alt fa-fw"></i>{{ $dog_prof[0]->location }}
                  </div>
                  @if($user_id !== (string)Auth::id() && $dog_prof[0]->follower === 1)
                    <div class="d-flex justify-content-end align-self-start">
                      <h6 class="text-light my-0">
                        <span class="badge bg-success py-1">フォローされています</span>
                      </h6>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="card-body py-0 mx-2">
            <div class="row">
              <div class="col h6 mb-0 small">年齢：{{ age($dog_prof[0]->dog_birthday) }}</div>
              <div class="col h6 mb-0 small">性別 ：{{ gender($dog_prof[0]->dog_gender) }}</div>
              <div class="col h6 mb-0 small">体重 ：{{ $dog_prof[0]->dog_weight }} kg</div>
            </div>
            <div class="row">
              <div class="col h6 mb-0 small">父犬種 ：{{ $dog_prof[0]->dog_daddy }}</div>
            </div>
            <div class="row">
              <div class="col h6 mb-0 small">母犬種 ：{{ $dog_prof[0]->dog_mommy }}</div>
            </div>
            <div class="row py-2">
              <div class="col">{{ $dog_prof[0]->dog_introduction }}</div>
            </div>
            <hr class="my-0">
            <div class="row d-flex py-2">
              <a href="{{ route('follower', ['user_id' => $user_id]) }}">
                <p class="mb-0 ml-3">{{ $dog_prof[0]->countFollow }} フォロー中</p>
              </a>
              <a href="{{ route('receiver', ['user_id' => $user_id]) }}">
                <p class="mb-0 ml-5">{{ $dog_prof[0]->countReceive }} フォロワー</p>
              </a>
            </div>
          </div>


          <hr class="my-0">

          <nav>
            <div class="nav nav-pills nav-justified nav-fill" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-shares-tab" data-toggle="tab"
                 href="#nav-shares" role="tab" aria-controls="nav-shares" aria-selected="true">
                投稿一覧
              </a>
              <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab"
                 href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="false">
                コメント
              </a>
              <a class="nav-item nav-link" id="nav-nices-tab" data-toggle="tab"
                 href="#nav-nices" role="tab" aria-controls="nav-nices" aria-selected="false">
                いいね
              </a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            {{--投稿一覧タブ--}}
            <div class="tab-pane fade show active" id="nav-shares" role="tabpanel" aria-labelledby="nav-home-tab">
              @if(!empty($shares))
                @foreach($shares as $post)

                  @include('layouts.postIndex')

                @endforeach
              @endif
            </div>

            {{--コメント一覧タブ--}}
            <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-profile-tab">
              @if(!empty($comments))
                @foreach($comments as $post)

                  @include('layouts.postIndex')

                @endforeach
              @endif
            </div>

            {{--いいね一覧タブ--}}
            <div class="tab-pane fade" id="nav-nices" role="tabpanel" aria-labelledby="nav-contact-tab">

              @foreach($nices as $post)

                @include('layouts.postIndex')

              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

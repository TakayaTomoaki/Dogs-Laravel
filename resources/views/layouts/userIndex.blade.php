<section>
  <a href="{{ route('mypage', ['user_id' => $user->user_id]) }}"
     class="list-group-item list-group-item-action">

    <div class="media mt-2 d-flex">
      @if($user->dog_image === null)
      <svg class="bd-placeholder-img rounded mr-3" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
           preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
        <title>Generic placeholder image</title>
        <rect width="100%" height="100%" fill="#868e96"/>
      </svg>
      @else
        <img src="{{ asset('storage/dog_image/'.$user->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
      @endif

      <div class="media-body">
        <div class="row">
          <div class="font-weight-bold mt-0 col">
            {{ $user->dog_name }}
            {{ nameTitle($user->dog_gender) }}
          </div>
          <div class="justify-content-end">
            @if($user->user_id !== Auth::id())
              <object>
                <form method="post" action="@if($user->follow === 0)
                {{ route('follow', ['user_id' => $user_id]) }}
                @else
                {{ route('unfollow', ['user_id' => $user_id]) }}@endif">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="{{ $user->user_id }}">
                  @if($user->follow == 0)
                    <button class="btn btn-primary btn-sm rounded-pill" type="submit">フォローする</button>
                  @else
                    <button class="btn btn-danger btn-sm rounded-pill" type="submit">フォロー解除</button>
                  @endif
                </form>
              </object>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col">{{ $user->location }}</div>
          <div class="col">{{ age($user->dog_birthday) }}</div>
          <div class="col">{{ $user->dog_weight }} kg</div>
        </div>
        <div class="row">
          <div class="col">犬種：
            {{--純血犬とMix犬とで表示を変更--}}
            @if($user->dog_daddy === $user->dog_mommy)
              {{ $user->dog_daddy }}
            @else
              {{ $user->dog_daddy }}
                           ×
              {{ $user->dog_mommy }}
            @endif
          </div>
        </div>
      </div>
    </div>
  </a>
</section>

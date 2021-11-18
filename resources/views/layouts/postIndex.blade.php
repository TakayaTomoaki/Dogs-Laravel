<section>
  <a href="{{ route('comment', ['id' => $post->id]) }}" class="list-group-item list-group-item-action">

    <div class="media mt-2">
      @if($post->dog_image === null)
        <svg class="bd-placeholder-img rounded align-self-start mr-3" width="60" height="60" xmlns="http://www.w3.org/2000/svg"
             preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Generic placeholder image">
          <title>Generic placeholder image</title>
          <rect width="100%" height="100%" fill="#868e96"/>
        </svg>
      @else
        <img src="{{ asset('storage/dog_image/'.$post->dog_image) }}" alt="dog_image" class="bd-placeholder-img rounded mr-3" width="60" height="60">
      @endif

      <div class="media-body">
        <div class="col d-flex pl-0">
          <div class="font-weight-bold mt-0">
            <object>
              <a href="{{ route('mypage', ['user_id'=>$post->user_id])}}">
                {{ $post->dog_name }}{{ nameTitle($post->dog_gender) }}
              </a>
            </object>
          </div>
          <div class="mb-0 ml-3 small">
            {{ date('n月j日', strtotime($post->created_at)) }}
          </div>
        </div>
        <p class="text-break mb-1" style="white-space:pre-wrap;">{{ $post->body }}</p>
        @if($post->image !== null)
          <img src="{{ asset('storage/image/'.$post->image) }}" alt="share_image" class="bd-placeholder-img rounded mr-3" width="150">
        @endif

        <div class="col d-flex pl-0 pt-2">
          {{-- いいねアイコン --}}
          <div class="col-4 d-flex align-items-center justify-content-center">
            <object>
              <form method="get" action="@if($post->count === 0){{ route('nice')}}@else{{ route('unlock') }}@endif">
                <input type="hidden" name="id" value="{{ $post->id }}">
                {{ csrf_field() }}
                <button type="submit" class="btn p-0 border-0 text-primary rounded-circle">
                  @if($post->count === 0)
                    <i class="fas fa-paw fa-fw" style="color:silver"></i>
                  @else
                    <i class="fas fa-paw fa-fw" style="color:red"></i>
                  @endif
                </button>
              </form>
            </object>
            <p class="mb-0 ml-2 text-secondary">{{ $post->nice }}</p>
          </div>
          {{-- コメントアイコン --}}
          <div class="col-4 d-flex align-items-center text-primary justify-content-center">
            <i class="far fa-comment fa-fw"></i>
            <p class="mb-0 ml-2 text-secondary">{{ $post->comment }}</p>
          </div>

          <div class="col-4 d-flex"></div>
        </div>
      </div>
    </div>
  </a>
</section>

@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card m-b-md">
          <div class="card-header">検索</div>
          <div class="card-body py-2">
            <form class="form-row" method="get" action="{{ route( 'search') }}">
              <div class="input-group">
                <input type="text" class="form-control rounded-pill" placeholder="名前・都道府県・犬種"
                       aria-label="Search" aria-describedby="button-addon" name="search">
                <div class="input-group-append">
                  <button class="btn btn-success rounded-pill" type="submit" id="button-addon">
                    　検索　
                  </button>
                </div>
              </div>
            </form>
          </div>

          @if(!empty($outputs))
            @foreach($outputs as $user)
              @if($user->user_id !== $user_id)

                @include('layouts.userIndex')

              @endif
            @endforeach
          @endif
        </div>

        @if(!empty($profiles) && empty($outputs))
          <div class="card m-b-md">
            <div class="card-header">近くのユーザー</div>
            @foreach($profiles as $user)
              @if ($user->user_id !== $user_id)

                @include('layouts.userIndex')

              @endif
            @endforeach
          </div>
        @endif


      </div>
    </div>
  </div>
@endsection

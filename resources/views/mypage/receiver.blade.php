@extends('layouts.common')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card m-b-md">
          <div class="card-header">フォローされているユーザー</div>
          @if(!empty($users))
            @foreach($users as $user)

              @include('layouts.userIndex')

            @endforeach
          @endif
        </div>

      </div>
    </div>
  </div>
@endsection

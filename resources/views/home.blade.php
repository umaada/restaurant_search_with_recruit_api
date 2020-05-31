@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
          @include('partials.sidebar')
        </div>
        <div class="col-md-8">

          <div class="row">

              @foreach($shops as $shop)
              <div class="col-lg-6">
                <div class="card mb-3 pl-1 pt-2">
                    <img src="{{ $shop->photo->pc->l }}" class="card-img-top d-block mx-auto" alt="ロゴ" style="width: 300px;">
                    <div class="card-body">
                      <h5 class="card-title">{{ $shop->name }}</h5>
                      <p class="card-text">{{ $shop->catch }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">{{ $shop->station_name }}</li>
                      <li class="list-group-item">{{ $shop->access }}</li>
                      <li class="list-group-item">{{ $shop->budget->average }}</li>
                    </ul>
                    <div class="card-body">
                      <a href="{{ $shop->urls->pc }}" target="_blank" class="btn btn-info" style="color:white">Hotpepper</a>

                    </div>
                </div>
              </div>
              @endforeach

          </div>

        </div>
    </div>
</div>
@endsection

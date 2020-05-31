@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-lg-4">
          @include('partials.sidebar')
        </div>
        <div class="col-md-7 col-lg-8">
          <nav class="mt-2 mb-2" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              @if($pagination['prev_page_url'])
                <li class="page-item">
                  <a class="page-link" href="{{ $pagination['prev_page_url'] }}">前</a>
                </li>
              @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">前</a>
                </li>
              @endif

              @for($i=1; $i<=$pagination['last_page']; $i++)
                @if($i == $pagination['current_page'])
                  <li class="page-item active" aria-current="page">
                    <span class="page-link">{{ $i }} <span class="sr-only">(current)</span></span>
                  </li>
                @else
                  <li class="page-item"><a class="page-link" href="{{ $pagination['base_url'] . "&page={$i}" }}">{{ $i }}</a></li>
                @endif
              @endfor

              @if($pagination['next_page_url'])
                <li class="page-item">
                  <a class="page-link" href="{{ $pagination['next_page_url'] }}">次</a>
                </li>
              @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">次</a>
                </li>
              @endif
            </ul>
          </nav>

          @if(!$shops)
            <div class="d-flex justify-content-center">
              <div class="alert alert-light mt-3" role="alert">
                条件に一致するレストランはありませんでした。
              </div>
            </div>
          @else
            <div class="d-flex justify-content-end">
              <div class="mb-3">
                全 {{ $pagination['all_results_count'] }}件中 {{ $pagination['results_start_num'] }}~{{ $pagination['results_end_num'] }}件を表示中
              </div>
            </div>
          @endif

          <div class="row justify-content-center">

              @foreach($shops as $shop)
              <div class="col-lg-6">
                <div class="card mb-3 pl-1 pt-2">
                    <img src="{{ $shop->photo->pc->l }}" class="card-img-top d-block mx-auto" alt="ロゴ" style="width: 270px;">
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

          <nav class="mt-5 mb-5" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              @if($pagination['prev_page_url'])
                <li class="page-item">
                  <a class="page-link" href="{{ $pagination['prev_page_url'] }}">前</a>
                </li>
              @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">前</a>
                </li>
              @endif

              @for($i=1; $i<=$pagination['last_page']; $i++)
                @if($i == $pagination['current_page'])
                  <li class="page-item active" aria-current="page">
                    <span class="page-link">{{ $i }} <span class="sr-only">(current)</span></span>
                  </li>
                @else
                  <li class="page-item"><a class="page-link" href="{{ $pagination['base_url'] . "&page={$i}" }}">{{ $i }}</a></li>
                @endif
              @endfor

              @if($pagination['next_page_url'])
                <li class="page-item">
                  <a class="page-link" href="{{ $pagination['next_page_url'] }}">次</a>
                </li>
              @else
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">次</a>
                </li>
              @endif
            </ul>
          </nav>

        </div>
    </div>
</div>
@endsection

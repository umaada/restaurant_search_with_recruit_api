

<!-- product right -->
  <div class="side-bar p-sm-4 p-3">
    <form action="#" method="get">
    <div class="search-hotel border-bottom py-2">

      <h3 class="agileits-sear-head mb-3">キーワード検索</h3>

      <input type="search" placeholder="大阪　居酒屋" value="{{ Request::get('keyword') }}" name="keyword" style="color:black;">
      <input type="submit" value=" ">

    </div>
    <!-- 都道府県 -->
    <div class="left-side border-bottom py-2">
      <h3 class="agileits-sear-head mb-3">エリア</h3>
      <area-search :large-areas="{{ $largeAreas }}"></area-search>
    </div>
    <!-- //都道府県 -->
    <!-- ジャンル -->
    <div class="range border-bottom py-2">
      <h3 class="agileits-sear-head mb-3">ジャンル</h3>
        <div class="form-group">
          <select name="genre" id="genre" class="form-control">
            @foreach($genres as $genre)
              @if($genre->code === Request::get('genre'))
                <option value="{{ $genre->code }}" selected>{{ $genre->name }}</option>
              @else
                <option value="{{ $genre->code }}">{{ $genre->name }}</option>
              @endif
            @endforeach
            <option value="">指定なし</option>
          </select>
        </div>
    </div>
    <!-- //ジャンル -->
    <!-- 予算 -->
    <div class="left-side border-bottom py-2">
      <h3 class="agileits-sear-head mb-3">予算</h3>
      <ul>
        @foreach($budgets as $budget)
          @if(Request::get('budget') && in_array($budget->code, Request::get('budget')))
            <li>
              <input class="budget-checkbox" type="checkbox" name="budget[]" value="{{ $budget->code }}" checked>
              <span class="span">{{ $budget->name }}</span>
            </li>
          @else
            <li>
              <input class="budget-checkbox" type="checkbox" name="budget[]" value="{{ $budget->code }}">
              <span class="span">{{ $budget->name }}</span>
            </li>
          @endif

        @endforeach
      </ul>
    </div>
    <!-- 予算 -->
    <!-- クレジットカード -->
    <div class="left-side border-bottom py-2">
      <h3 class="agileits-sear-head mb-3">クレジットカード</h3>
      <ul>
        @foreach($creditCards as $creditCard)
          @if(Request::get('credit-card') && in_array($creditCard->code, Request::get('credit-card')))
            <li>
              <input class="credit-card-checkbox" type="checkbox" name="credit-card[]" value="{{ $creditCard->code }}" checked>
              <span class="span">{{ $creditCard->name }}</span>
            </li>
          @else
            <li>
              <input class="credit-card-checkbox" type="checkbox" name="credit-card[]" value="{{ $creditCard->code }}">
              <span class="span">{{ $creditCard->name }}</span>
            </li>
          @endif
        @endforeach
      </ul>
    </div>
    <!-- クレジットカード -->
  </form>
  </div>
  <!-- //product right -->

@extends('welcome')
@section('content')
<section id="page-title" style="background-image:url({{asset('images/pexels-photo-10060360.jpeg')}})">
    <div class="container">
        <div class="page-title">
            <h1>Каталог</h1>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ asset('/') }}">Главная</a> </li>
                <li class="active"><a href="#">Каталог</a></li>
            </ul>
        </div>
    </div>
</section>
        <!-- Content -->
        <section id="page-content">
            <div class="container mb-4">
                <div class="row flex-row-reverse">
                    <!-- Portfolio -->
                    <div class="content col-lg-9" id="coins">
                        @if(count($coins) > 0)
                            <!-- Coins -->
                            @foreach ($coins as $coin)
                                <div class="book-item border-bottom d-flex flex-column flex-md-row mt-3">
                                    <div class="item-photo mr-md-5 text-center pb-4">
                                        @if ($coin->image == NULL)
                                            <img alt="" src="https://sun9-57.userapi.com/lw1tXZTzDiewjVHZh07fFTDM-jNNd-icimnskw/M-KpsHFpZhY.jpg" width='200' height='300'>
                                        @else
                                            <img alt="" src="{{ Voyager::image( $coin->image ) }}" width='200' >
                                        @endif
                                    </div>
                                    <div class="item-desc">
                                        <ul class="list-unstyled">
                                            <li class="d-flex d-md-block justify-content-center text-right">
                                                @if(Auth::check())
                                                    <button type="button" class="js-adding-modal btn btn-light" coinId="{{ $coin->id }}" coinPrice="{{ $coin->price }}" data-toggle="modal" data-target="#addModal">Сделать ставку</button>
                                                    @foreach ($bets as $bet)
                                                        @if ($bet->coin_id == $coin->id)
                                                            <div>Ваша ставка: {{ $bet->price }}</div>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <button type="button" class="js-adding-modal btn btn-light" coinId="{{ $coin->id }}" data-toggle="modal" data-target="#addModal">Сделать ставку</button>
                                                @endif
                                            </li>
                                                <li><strong>Окончание: </strong>{{ $coin->created_at->addDays(30)->format('Y-m-d H:i') }}</li>
                                                <li><strong>Категория: </strong>{{ $coin->category->name }}</li>
                                                <li><strong>Страна: </strong>{{ $coin->country->name }}</li>
                                                <li><strong>Имя владельца: </strong>{{ $coin->user->name }}</li>
                                                <li><strong>Цена: </strong>{{ $coin->price }} бел. руб.</li>
                                                <li><strong>Название: </strong>{{ $coin->name }}</li>
                                                <li><strong>Год: </strong>{{ date('Y', strtotime($coin->year)) }}</li>
                                        </ul>
                                        <p>{{ $coin->description}}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="h3 text-center">
                                Ничего не найдено по вашему запросу
                            </div>
                        @endif
                    </div>
                    <!-- end: Portfolio -->

                    <div class="sidebar col-lg-3">
                        <!--widget newsletter-->
                        <div class="widget  widget-newsletter">
                            <form id="widget-search-form-sidebar" action="/search" method="get">
                                <div class="input-group">
                                    <input type="text" aria-required="true" name="query" class="form-control widget-search-form" placeholder="Поиск по названию">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--end: widget newsletter-->
                        <div id="widget-sort-form-sidebar" class="widget widget-newsletter">
                            <h4 class="widget-title">Сортировка</h4>
                            <form action="/sort" method="get">
                                <div class="sorting">
                                    <select class="form-control" name="sorting" onchange="this.form.submit();">
                                        @switch($sortArr)
                                            @case('name,asc')
                                                <option value="id,asc">По умолчанию</option>
                                                <option value="name,asc" selected>По названию: А-Я</option>
                                                <option value="name,desc">По названию: Я-А</option>
                                                <option value="author,asc">По году: А-Я</option>
                                                <option value="author,desc">По году: Я-А</option>
                                                @break
                                            @case('name,desc')
                                                <option value="id,asc">По умолчанию</option>
                                                <option value="name,asc">По названию: А-Я</option>
                                                <option value="name,desc" selected>По названию: Я-А</option>
                                                <option value="year,asc">По году: А-Я</option>
                                                <option value="year,desc">По году: Я-А</option>
                                                @break
                                            @case('year,asc')
                                                <option value="id,asc">По умолчанию</option>
                                                <option value="name,asc">По названию: А-Я</option>
                                                <option value="name,desc">По названию: Я-А</option>
                                                <option value="year,asc" selected>По году: А-Я</option>
                                                <option value="year,desc">По году: Я-А</option>
                                                @break
                                            @case('year,desc')
                                                <option value="id,asc">По умолчанию</option>
                                                <option value="name,asc">По названию: А-Я</option>
                                                <option value="name,desc">По названию: Я-А</option>
                                                <option value="year,asc">По году: А-Я</option>
                                                <option value="year,desc" selected>По году: Я-А</option>
                                                @break
                                            @default
                                                <option value="id,asc">По умолчанию</option>
                                                <option value="name,asc">По названию: А-Я</option>
                                                <option value="name,desc">По названию: Я-А</option>
                                                <option value="year,asc">По году: А-Я</option>
                                                <option value="year,desc">По году: Я-А</option>
                                        @endswitch
                                    </select>
                                </div>
                            </form>
                        </div>
                        <!-- widget -->
                        <div class="widget">
                            <h4 class="widget-title">Категории</h4>
                            <ul class="list-unstyled">
                                <li><a id="js-category-all" href="{{ asset('catalog/') }}">Все</a></li>
                                @foreach($categories as $category)
                                    <li><a id="js-category-{{$category->id}}" href="{{ asset("catalog/category/".$category->id) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <h4 class="widget-title">Страны</h4>
                            <ul class="list-unstyled">
                                <li><a id="js-country-all" href="{{ asset('catalog/') }}">Все</a></li>
                                @foreach($countries as $country)
                                    <li><a id="js-country-{{$country->id}}" href="{{ asset('catalog/country/'.$country->id) }}">{{ $country->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <h4 class="widget-title">Стоимость</h4>
                            <ul class="list-unstyled">
                                <li><a id="js-price-all" href="{{ asset('catalog/') }}">Все</a></li>
                                <li><a id="js-price-<100" href="{{ asset('catalog/price/<100') }}"><100</a></li>
                                <li><a id="js-price-100-300" href="{{ asset('catalog/price/100-300') }}">100-300</a></li>
                                <li><a id="js-price-301-500" href="{{ asset('catalog/price/301-500') }}">301-500</a></li>
                                <li><a id="js-price-501-800" href="{{ asset('catalog/price/501-800') }}">501-800</a></li>
                                <li><a id="js-price-801-1100" href="{{ asset('catalog/price/801-1100') }}">801-1100</a></li>
                                <li><a id="js-price-1101-1400" href="{{ asset('catalog/price/1101-1400') }}">1101-1400</a></li>
                                <li><a id="js-price-1401-1700" href="{{ asset('catalog/price/1401-1700') }}">1401-1700</a></li>
                                <li><a id="js-price->1700" href="{{ asset('catalog/price/>1700') }}">>1700</a></li>
                            </ul>
                        </div>
                        <!-- end: widget-->
                    </div>
            </div>
        {!! $coins->links() !!}

        </section> <!-- end: Content -->

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center p-0" id="registerModalLabel">Сделать ставку</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="adding-coin-form" id="addForm" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="align-items-center d-flex flex-column">
                                <div class="form-group">
                                    <label for="price" class="text-center">Укажите ставку:</label>
                                    <input type="number" step="0.1" min=0.1 id="price" name="price" placeholder="Ставка">
                                </div>
                                <div class="form-group mt-4 align-items-center d-flex flex-column">
                                    @if(Auth::check() && Auth::user()->role_id != 1)
                                        <a href="##" class="btn btn-primary js-add-coin">Сделать ставку</a>
                                        <div class="auth-error text-center text-success text-danger"></div>
                                    @else
                                        <a href="##" class="btn btn-primary disabled js-add-coin">Сделать ставку</a>
                                        <div class="auth-error text-danger">
                                            Для повышения ставки нужно быть авторизованным
                                        </div>
                                    @endif
                                </div>
                            </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
@endsection

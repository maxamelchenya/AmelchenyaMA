@extends('welcome')
@section('content')
    <section id="page-title"  style="background-image:url({{asset('images/service-1019821_1920.jpg')}})">
        <div class="container">
            <div class="page-title">
                <h1>Сервисы</h1>
                <span>Выбирайте услуги, которые подходят именно вам.</span>
            </div>
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{asset ('/') }}">Главня</a> </li>
                    <li class="active"><a href="#">Сервисы</a> </li>
                </ul>
            </div>
        </div>
    </section>
    @isset ($services)
        @php
            $i=0
        @endphp
        @foreach ($services as $service)
            @php
                $i++
            @endphp
            @if ($i%2 != 0)
                <section class="background-grey p-b-0">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="heading-text heading-section text-right mt-5">
                                    <h1>{{ $service->title }}</h1>
                                    <p>{{ $service->body }}</p>
                                </div>
                            </div>
                            <div class="col-lg-5"> <img class="img-fluid" alt="" src="{{ Voyager::image( $service->image ) }}"> </div>
                        </div>
                    </div>
                </section>
            @else
                <section class="background-grey p-b-0">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-5"> <img class="img-fluid" alt="" src="{{ Voyager::image( $service->image ) }}"> </div>
                            <div class="col-lg-7">
                                <div class="heading-text heading-section text-right mt-5">
                                    <h1>{{ $service->title }}</h1>
                                    <p>{{ $service->body }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endisset

@endsection

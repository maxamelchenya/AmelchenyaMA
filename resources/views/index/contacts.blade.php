@extends('welcome')
@section('content')

<section id="page-title" style="background-image:url({{asset('images/pexels-photo-4051134.jpeg')}})">
    <div class="container">
        <div class="page-title">
            <h1>Контакты</h1>
            <span>Появились вопросы или хотите предложить сотрудничество? Сообщите нам.</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ asset('/') }}">Главная</a> </li>
                <li class="active"><a href="#">Контакты</a></li>
            </ul>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-uppercase">Свяжитесь с нами</h3>
                <p>Наша платформа не осуществляет покупку (обратный выкуп) у клиентов памятных банкнот, памятных и слитковых (инвестиционных) монет, а также прием указанных банкнот и монет по номинальной стоимости. Исключением являются памятные монеты, поступившие из обращения и имеющие технические характеристики (достоинство, диаметр, сплав, масса), аналогичные монетам в белорусских рублях (памятные монеты номиналом 2 рубля), которые принимаются ОАО «АСБ Беларусбанк» по номинальной стоимости в качестве законного платежного средства Республики Беларусь.</p>
                <p>Денежные знаки разных стран — настоящая страсть для многих коллекционеров. Для настоящих ценителей истории, старинных и интересных вещей на нашем сайте открыты аукционы монет в Беларуси. Любой нумизмат может разместить здесь своё сообщение, пополнить коллекцию или поделиться ненужными образцами.</p>
                <div class="row m-t-40">
                    <div class="col-lg-6">
                        <address>
                            <strong>Компания Аукциончик</strong><br>
                            220234, Россия, г. Москва<br>
                            Ул. Пушкина, д. 6, корп. 1<br>
                            <abbr title="Phone">Т:</h4> 8(029) 556-08-45
                        </address>
                    </div>
                    <div class="col-lg-6">
                        <address>
                            <strong>Офис Аукциончик</strong><br>
                            212042, Республика Беларусь, г. Минск<br>
                            Проспект Мурина, д. 86, корп. 3, оф. 544<br>
                            <abbr title="Phone">Т:</h4> 8(033) 582-94-52
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--<section class="no-padding">--}}
{{--    <!-- Google Map -->--}}
{{--    <div class="map" data-latitude="-37.817240" data-longitude="144.955826" data-style="light" data-info="Hello from &lt;br&gt; Inspiro Themes" data-height-lg="500" data-height-xs="200" data-height-sm="300"></div>--}}
{{--    <!-- end: Google Map -->--}}
{{--</section>--}}

@endsection

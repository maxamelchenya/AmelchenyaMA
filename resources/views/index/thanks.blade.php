@extends('welcome')
@section('content')
<div class="container mt-lg-5">
    <h3 class="mb-5 text-center">Ваша монета добавлена</h3>
    <div class="row" style="font-size: larger;">
				<div class="col-md-6 d-md-flex justify-content-center">
					<div class="details_item">
						<ul class="list">
							<li><span>Номер монеты</span> : {{$coin->id}}</li>
							<li><span>Название</span> : {{$coin->name}}</li>
							<li><span>Страна</span> : {{$coin->country->name}}</li>
							<li><span>Категория</span> : {{$coin->category->name}}</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 d-md-flex justify-content-center mt-5 mt-md-0">
					<div class="details_item">
						<ul class="list">
							<li><span>Стоимость</span> : {{$coin->price}}</li>
							<li><span>Состояние</span> : {{$coin->condition}}</li>
							<li><span>Описание</span> : {{$coin->description}}</li>
						</ul>
					</div>
				</div>
			</div>
<div>
@endsection
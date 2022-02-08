@extends('welcome')
@section('content')
<div class="card container">
    <div class="card-body">
        <h3 class="mb-5 text-center">Заполните анкету</h3>
        <form id="form1" class="form-validate" action="/adding" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="name" placeholder="Введите название" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Цена</label>
                    <input type="number" step="0.1" class="form-control" name="price" placeholder="Введите стоимость" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="condition">Состояние</label>
                    <input class="form-control" type="text" name="condition" placeholder="Укажите состояние"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="year">Год</label>
                    <input type="number" step="1" min=0 class="form-control" name="year" placeholder="Введите год" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" placeholder="Введите описание" rows="3"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label w-100">Фото</label>
                    <input type="file" name="image" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category">Категории</label>
                    <select name="category" class="form-control" required>
                        <option value="">Выберите категорию</option>
                        @isset($categories)
                            @foreach ($categories as $category)
                                <option>{{ $category->name }} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="country">Страна</label>
                    <select name="country" class="form-control" required>
                        <option value="">Выберите страну</option>
                        @isset($countries)
                            @foreach ($countries as $country)
                                <option>{{ $country->name }} </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <button type="submit" class="btn m-t-30 mt-3">Добавить</button>
            <a class="btn m-t-30 mt-3 btn-white" href="/">На главную</a>
        </form>
    </div>
</div>
@endsection
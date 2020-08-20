@extends('layouts.app')

@section('title')
    Лодки и Катера
@endsection

@section('meta')
    <meta name="description"
        content="Компания Лаборатория Экспериментального Судостроения изготавливает надёжные и качественные моторные лодки и катера из алюминия и нержавеющей стали существующих моделей, а также по индивидуальным чертежам.
        Работаем в Астрахани, доставляем по всей России и СНГ. Телефон: 8(908)619-0020, 8(927)564-4115">
    <meta name="keywords" content="лодки, катера, астрахань, алюминий, алюминиевые лодки">
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/readmore.css">
@endsection

@section('content')

    <div class="container mb-3 mt-3">

        <div class="container-fluid d-flex flex-row justify-content-center" style="padding: 3em 0em 3em 0em;">
            <h1 class="line-crossed align-self-center"><span>Выбери лодку мечты</span></h1>
        </div>

        @auth
            <a href="{{ route('gallery.create') }}" class="btn btn-primary m-3">Создать</a>
        @endauth

        @if (session()->get('success'))
            <div class="jumbotron alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="container-fluid">
            <form action="{{ route('gallery.index') }}" method="get">
                <div class="d-flex flex-row justify-content-start">
                    <div class="input-group mr-3 w-auto">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="boat_category">Категория</label>
                        </div>
                        <select class="custom-select" name="category">
                            <option value="All" selected>All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <button class="btn btn-green-fill" type="submit">Поиск</button>
                    </div>
                </div>
            </form>
        </div>

        @if (!empty($boats))
            <div class="row">
                @foreach ($boats as $boat)
                    <div class="col-xl-4 col-md-6 mt-3">
                        <div class="card">
                            @isset($boat->img)
                                <img src="{{ asset('/storage/' . $boat->img) }}" alt="{{ $boat->title }}"
                                    class="card-img-top obj-fit-cov" style="height: 300px;">
                            @endisset
                            <div class="card-body">
                                <h3 class="card-title mx-auto">{{ $boat->title }}</h3>
                                <h6 class="card-subtitle mb-2">Price: {{ $boat->price }} &#8381;</h6>
                                
                                <div class="content_block hide" id="{{ 'text_' . $boat->id . '_block' }}">
                                    <p class="card-text">{!! nl2br($boat->description) !!}</p>
                                </div>
                                <a class="content_toggle" href="#" id="{{ 'text_' . $boat->id . '_toggle' }}">Показать полностью</a>
                                
                                <div class="d-flex flex-column flex-md-row justify-content-md-start mt-2" role="group">
                                    <a href="{{ route('gallery.show', $boat->id) }}"
                                        class="btn btn-orange btn-outline-orange mr-md-2 mb-2">Подробнее</a>
                                    @auth
                                        <a href="{{ route('gallery.edit', $boat->id) }}"
                                            class="btn btn-warning mr-md-2 mb-2">Редактировать</a>
                                        <form action="{{ route('gallery.destroy', $boat->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger w-100 w-md-auto" type="submit">Удалить</button>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/readmore.js') }}"></script>
@endpush
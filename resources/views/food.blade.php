@extends('partials.main')

@section('title','دستور پخت و موارد مورد نیاز ' . $food->name)

@section('description')آموزش و دستور پخت {{$food->name}} به همراه موارد مورد نیاز به صورت کامل و دقیق@endsection

@section('keywords',$food->name . ', دستور پخت, مواد مورد نیاز')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="card mb-3">
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="food-image-large mb-3"
                                 style="background-image: url('/images/foods/{{$food->id}}.jpg')"></div>


                            <h1 class="fw-bold text-center text-danger mb-3" id="food-title">{{$food->name}}</h1>
                            <div class="text-center">
                            <span class="fw-bold">
                                دسته بندی:
                            </span>
                                @foreach($food->categories as $index => $category)
                                    <a href="{{route('category',$category)}}"
                                       class="text-decoration-none text-body">{{$category}}</a>
                                    @if($index < count($food->categories) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>

                            <div class="mb-3 text-center">
                            <span class="fw-bold">
                                مناسب برای:
                            </span>
                                @foreach($food->meals as $index => $meal)
                                    <a href="{{route('meal',$meal)}}"
                                       class="text-decoration-none text-body">{{$meal}}</a>
                                    @if($index < count($food->meals) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>

                            <hr>

                            @if($food->tags)
                                <div class="mt-1 mb-3 text-center">
                                    <div class="row justify-content-center d-flex">
                                        @foreach($food->tags as $index => $tag)
                                            <div class="p-2 col-md-6 col-lg-3">
                                                <div class="bg-secondary text-white p-2">
                                                    {{$index . ': ' . $tag}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>
                            @endif

                            <h3 class="text-center text-danger fw-bold mb-3">موارد مورد نیاز</h3>
                            <ul class="pe-5">
                                @foreach(explode(PHP_EOL,$food->items_needed) as $item_needed)
                                    <li>{{$item_needed}}</li>
                                @endforeach
                            </ul>

                            <hr>

                            <h3 class="text-center text-danger fw-bold mb-3">دستور پخت</h3>
                            <ul class="pe-5">
                                @foreach(explode(PHP_EOL,$food->recipe) as $recipe)
                                    <li class="mb-2">{{$recipe}}</li>
                                @endforeach
                            </ul>
                            <p>{!! nl2br($food->details) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div id="pos-article-display-25167"></div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h2 class="text-center text-danger fw-bold mb-4">موارد مشابه</h2>
        @include('food-list',['foods' => $related])
    </div>
@endsection

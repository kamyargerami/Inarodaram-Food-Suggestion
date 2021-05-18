@extends('partials.main')

@section('title',$food->name)

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="col-md-8 pt-3">
            <div class="card mb-3">
                <div class="card-body pt-1">
                    <div class="row">
                        <div class="food-image-large mb-3"
                             style="background-image: url('/images/foods/{{$food->id}}.jpg')"></div>


                        <h1 class="fw-bold text-center text-danger mb-3">{{$food->name}}</h1>
                        <div class="text-center">
                            <span class="fw-500">
                                دسته بندی:
                            </span>
                            @foreach($food->categories as $index => $category)
                                <span>{{$category}}</span>
                                @if($index < count($food->categories) - 1)
                                    ,
                                @endif
                            @endforeach
                        </div>

                        <div class="mb-3 text-center">
                            <span class="fw-500">
                                مناسب برای وعده:
                            </span>
                            @foreach($food->meals as $index => $meal)
                                <span>{{$meal}}</span>
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
                        <p>{!! nl2br($food->items_needed) !!}</p>

                        <hr>

                        <h3 class="text-center text-danger fw-bold mb-3">راهنمای پخت</h3>
                        <p>{!! nl2br($food->recipe) !!}</p>
                        <p>{!! nl2br($food->details) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('main')

@section('title',$food->name)

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="food-image-large mb-3"
                             style="background-image: url('/images/foods/{{$food->id}}.jpg')"></div>


                        <h1 class="font-weight-bolder">{{$food->name}}</h1>
                        <div>
                            دسته بندی:
                            @foreach($food->categories as $index => $category)
                                <span>{{$category}}</span>
                                @if($index < count($food->categories) - 1)
                                    ,
                                @endif
                            @endforeach
                        </div>

                        <div>
                            مناسب برای وعده:
                            @foreach($food->meals as $index => $meal)
                                <span>{{$meal}}</span>
                                @if($index < count($food->meals) - 1)
                                    ,
                                @endif
                            @endforeach
                        </div>

                        <div class="mt-3 mb-3">
                            @if($food->tags)
                                @foreach($food->tags as $index => $tag)
                                    <span class="bg-secondary text-white p-2">{{$index . ': ' . $tag}}</span>
                                @endforeach
                            @endif
                        </div>

                        <h2>موارد مورد نیاز</h2>
                        <p>{!! nl2br($food->items_needed) !!}</p>

                        <h2>راهنمای پخت</h2>
                        <p>{!! nl2br($food->recipe) !!}</p>
                        <p>{!! nl2br($food->details) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('main')

@section('title',$food->name)

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="food-image-small"
                                 style="background-image: url('/images/foods/{{$food->id}}.jpg')"></div>
                        </div>
                        <div class="col-md-9">
                            <h4 class="font-weight-bolder">{{$food->name}}</h4>
                            <div>
                                @foreach($food->categories as $index => $category)
                                    <span>{{$category}}</span>
                                    @if($index < count($food->categories) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>

                            <div>
                                @foreach($food->meals as $index => $meal)
                                    <span>{{$meal}}</span>
                                    @if($index < count($food->meals) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>

                            <div>
                                @foreach($food->requirements as $index => $requirement)
                                    <span>{{$requirement}}</span>
                                    @if($index < count($food->requirements) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

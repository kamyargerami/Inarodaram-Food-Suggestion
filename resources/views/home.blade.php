@extends('main')

@section('title','چی بپزم؟')

@section('content')
    <div class="container justify-content-center d-flex">
        <div class="col-md-8">
            <form action="" method="post">
                @csrf

                <div class="bg-main p-3 mb-3 mt-3">
                    <div class="mb-3">
                        <input type="text" name="name" placeholder="نام غذا" class="form-control">
                    </div>


                    <select class="select2" name="requirements" multiple>
                        @foreach($requirements as $requirement)
                            <option value="{{$requirement}}">{{$requirement}}</option>
                        @endforeach
                    </select>

                    <select name="" class="form-control mb-3 mt-3">
                        <option value="">برای چه وعده ای میخوای؟</option>
                        <option value="ناهار">ناهار</option>
                        <option value="شام">شام</option>
                        <option value="افطاری">افطاری</option>
                        <option value="میان وعده">میان وعده</option>
                        <option value="عصرانه">عصرانه</option>
                        <option value="پیش غذا">پیش غذا</option>
                        <option value="صبحانه">صبحانه</option>
                        <option value="دسر">دسر</option>
                    </select>

                    <select name="" class="form-control mb-3">
                        @foreach($categories as $category)
                            <option value="{{$category}}">{{$category}}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-warning btn-block w-100">جستجو</button>
                </div>
            </form>

            @foreach($foods as $food)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('view',$food->id)}}">
                                    <div class="food-image-small"
                                         style="background-image: url('/images/foods/{{$food->id}}.jpg')"></div>
                                </a>
                            </div>
                            <div class="col-md-9">
                                <a href="{{route('view',$food->id)}}">
                                    <h4 class="font-weight-bolder">{{$food->name}}</h4>
                                </a>
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

                                <div>
                                    مواد مورد نیاز:
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
            @endforeach
        </div>
    </div>
@endsection

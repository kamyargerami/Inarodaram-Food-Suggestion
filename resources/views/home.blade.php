@extends('main')

@section('title','چی بپزم؟')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            دسته بندی ها
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)
                                <li><a class="dropdown-item" href="#">{{$category}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            وعده های غذایی
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">ناهار</a></li>
                            <li><a class="dropdown-item" href="#">شام</a></li>
                            <li><a class="dropdown-item" href="#">صبحانه</a></li>
                            <li><a class="dropdown-item" href="#">دسر</a></li>
                            <li><a class="dropdown-item" href="#">پیش غذا</a></li>
                            <li><a class="dropdown-item" href="#">عصرانه</a></li>
                            <li><a class="dropdown-item" href="#">میان وعده</a></li>
                            <li><a class="dropdown-item" href="#">افطاری</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <form>
            <div class="bg-main p-3 mb-3 mt-3 p-5">
                <h2 class="text-center text-light fw-bold mb-5">بگو تو خونه چی داری تا بهت بگم چی بپزی؟</h2>
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <select class="select2" name="requirements[]" multiple>
                            @foreach($requirements as $requirement)
                                <option
                                    value="{{$requirement}}" {{in_array($requirement,(request('requirements') ?: [])) ? 'selected' : ''}}>{{$requirement}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <button class="btn btn-warning btn-block w-100 mt-3 mt-md-0">جستجو</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            @foreach($foods as $food)
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{route('view',$food->id)}}">
                                        <div class="food-image-small"
                                             style="background-image: url('/images/foods/{{$food->id}}.jpg')"></div>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <a href="{{route('view',$food->id)}}" class="text-decoration-none text-dark">
                                        <h4 class="font-weight-bolder">{{$food->name}}</h4>
                                    </a>
                                    <div>
                                        <span class="fw-500">دسته بندی:</span>
                                        @foreach($food->categories as $index => $category)
                                            <span>{{$category}}</span>
                                            @if($index < count($food->categories) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>

                                    <div>
                                        <span class="fw-500">مناسب برای وعده:</span>
                                        @foreach($food->meals as $index => $meal)
                                            <span>{{$meal}}</span>
                                            @if($index < count($food->meals) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>

                                    <div>
                                        <span class="fw-500">مواد مورد نیاز:</span>
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
            @endforeach
        </div>
    </div>
@endsection

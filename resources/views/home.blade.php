@extends('partials.main')

@section('title','با این وسایل چی بپزم؟ - وب سایت اینارو دارم')

@section('description')دستور پخت و آموزش کامل پخت غذاهای ایرانی و خارجی به همراه دستور عمل ها و مواد مورد نیاز در وب سایت اینارو دارم@endsection

@section('keywords','اینارو دارم, چی بپزم, دستور پخت')

@section('content')
    <div class="container">
        <form action="/">
            <div class="bg-main p-3 mb-3 mt-3 p-5">
                <h2 class="text-center text-light fw-bold mb-5">بگو تو خونه چی داری تا بهت بگم چی بپزی؟</h2>
                <div class="row">
                    <div class="col-md-8 col-lg-9">
                        <select class="select2" name="requirements[]" multiple>
                            @foreach(\Illuminate\Support\Facades\Cache::get('requirements') as $requirement)
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
                                        <h3 class="font-weight-bolder fw-bold font-20">{{$food->name}}</h3>
                                    </a>
                                    <div class="mt-4">
                                        <span class="text-danger fw-bold">دسته بندی:</span>
                                        @foreach($food->categories as $index => $category)
                                            <span>{{$category}}</span>
                                            @if($index < count($food->categories) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>

                                    <div>
                                        <span class="text-danger fw-bold">مناسب برای وعده:</span>
                                        @foreach($food->meals as $index => $meal)
                                            <span>{{$meal}}</span>
                                            @if($index < count($food->meals) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>

                                    <div>
                                        <span class="text-danger fw-bold">مواد مورد نیاز:</span>
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

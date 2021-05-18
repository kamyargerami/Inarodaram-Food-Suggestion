@extends('partials.main')

@section('title')
    @if(request('category'))
        فهرست غذا های دسته بندی {{request('category')}} - وب سایت اینارو دارم
    @elseif(request('meal'))
        فهرست غذا ها در وعده  {{request('meal')}} - وب سایت اینارو دارم
    @else
        با این وسایل چی بپزم؟ - وب سایت اینارو دارم
    @endif

    @if(request('page') and request('page') > 1)
        -
        صفحه {{request('page')}}
    @endif
@endsection

@section('description')
    @if(request('category'))
        دستور پخت و آموزش پخت {{request('category')}} به همراه دستورعمل ها و مواد مورد نیاز در وب سایت اینارو دارم
    @elseif(request('meal'))
        دستور پخت و آموزش پخت انواع {{request('meal')}} به همراه دستورعمل ها و مواد مورد نیاز در وب سایت اینارو دارم
    @else
        دستور پخت و آموزش کامل پخت غذاهای ایرانی و خارجی به همراه دستور عمل ها و مواد مورد نیاز در وب سایت اینارو دارم
    @endif
@endsection

@section('keywords','اینارو دارم, چی بپزم, دستور پخت')

@section('content')
    <div class="container">
        @include('search-box')


        @if(!count($foods) and request('name'))
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-danger text-center fw-bold">کلمه مورد نظر شما یافت نشد</h4>
                        <p class="text-center">
                            شما میتوانید با تغییر نام غذا به آیتم های دیگر دسترسی داشته باشید
                        </p>
                    </div>
                </div>
            </div>
        @else
            @include('food-list')

            @if($similar_foods)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center text-danger fw-bold">
                                @if(!count($foods))
                                    موردی که شامل همه مواد غذایی شما باشد موجود نیست
                                @else
                                    همچنین موارد نزدیک به مواد غذایی شما موجود است
                                @endif
                            </h4>
                            <h6 class="text-center">موارد زیر حداقل یکی از مواد عذایی شما را شامل می شود</h6>
                        </div>
                    </div>
                </div>
                @include('food-list',['foods'=>$similar_foods])
            @endif
        @endif

        <div class="d-flex justify-content-center">
            {{$foods->withQueryString()->links()}}
        </div>
@endsection

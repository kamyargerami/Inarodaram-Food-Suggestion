<div class="row">
    @if(!count($foods))
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(request('requirements'))
                        <h4 class="text-danger text-center">ترکیب مورد نظر شما یافت نشد</h4>
                        <p class="text-center">
                            شما میتوانید با تغییر یا حذف موارد موجود خودتون به غذا های دیگه ای دسترسی داشته باشین
                        </p>
                    @elseif(request('name'))
                        <h4 class="text-danger text-center">کلمه مورد نظر شما یافت نشد</h4>
                        <p class="text-center">
                            شما میتوانید با تغییر نام غذا به آیتم های دیگر دسترسی داشته باشید
                        </p>
                    @endif
                </div>
            </div>
        </div>
    @endif
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
                                <h3 class="font-weight-bolder fw-bold font-20 pt-3 pt-md-0">{{$food->name}}</h3>
                            </a>
                            <div class="mt-4">
                                <span class="text-danger fw-bold">دسته بندی:</span>
                                @foreach($food->categories as $index => $category)
                                    <a href="{{route('category',$category)}}"
                                       class="text-decoration-none text-body">{{$category}}</a>
                                    @if($index < count($food->categories) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>

                            <div class="mt-1">
                                <span class="text-danger fw-bold">مناسب برای وعده:</span>
                                @foreach($food->meals as $index => $meal)
                                    <a href="{{route('category',$meal)}}"
                                       class="text-decoration-none text-body">{{$meal}}</a>
                                    @if($index < count($food->meals) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>

                            <div class="mt-1">
                                <span class="text-danger fw-bold">مواد مورد نیاز:</span>
                                @foreach($food->requirements as $index => $requirement)
                                    <span>{{$requirement}}</span>
                                    @if($index < count($food->requirements) - 1)
                                        ,
                                    @endif
                                @endforeach
                            </div>
                            <p class="text-start mb-0 mt-1 font-13">
                                <a href="{{route('view',$food->id)}}" class="text-success text-decoration-none">
                                    <span>دستور پخت</span>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path
                                            d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                        <path
                                            d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

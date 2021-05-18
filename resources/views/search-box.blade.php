<form action="/">
    <div class="bg-main mb-3 mt-3 p-3 p-sm-4 p-md-5 p-lg-6">
        <h2 class="text-center text-light fw-bold mb-3 mb-sm-5" id="search-title">
            بگو تو خونه چی داری تا بهت بگم چی بپزی؟
        </h2>
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
                <button class="btn btn-warning btn-block w-100 mt-3 mt-md-0">
                    جستجو

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-search me-2" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</form>

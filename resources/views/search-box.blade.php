<form action="/">
    <div class="bg-main mb-3 mt-3 p-3 p-sm-4 p-md-5 p-lg-6">
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

@if (Session::has('error'))
    <div class="m-3">
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    </div>
@endif

@if (Session::has('msg'))
    <div class="m-3">
        <div class="alert alert-success">{{ Session::get('msg') }}</div>
    </div>
@endif
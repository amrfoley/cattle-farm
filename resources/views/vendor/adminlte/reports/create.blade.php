@extends('adminlte::layouts.app')

@section('htmlheader_title')
    records
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1 py-3">Add new record</h1>
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if($pastures->count() > 0 && $cattles->count() > 0)
                <div class="form-row mb-3">
                    <div class="col-md-6">
                    <select class="custom-select" name="pasture_id">
                        <option {{ old('pasture_id') === '' ? "selected" : ""}}>Choose Pasture</option>
                        @foreach($pastures as $pasture)
                            <option value="{{ $pasture->id }}" {{ old('pasture_id') === $pasture->id ? "selected" : ""}} >
                                {{ $pasture->name }}
                            </option>
                        @endforeach                        
                    </select>
                    </div>
                    <div class="col-md-6">
                    <select class="custom-select" name="cattle_ids[]" multiple>
                        <option {{ old('cattle_id') === '' ? "selected" : ""}}>Choose cattle</option>
                        @foreach($cattles as $cattle)
                            <option value="{{ $cattle->id }}" {{ old('cattle_id') === $cattle->id ? "selected" : ""}} >
                                {{ $cattle->serial }}
                            </option>
                        @endforeach                        
                    </select>
                    </div>
                </div>
                <div class="py-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                @else
                    <a href="{{ route('pastures.create') }}" class="btn btn-lg btn-primary">Add Pasture First</a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
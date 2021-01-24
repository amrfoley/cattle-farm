@extends('adminlte::layouts.app')

@section('htmlheader_title')
    cattles
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1 py-3">Add new cattle</h1>
            <form action="{{ route('cattles.store') }}" method="POST">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if($pastures->count() > 0)
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" 
                            id="bull"
                            name="gender"
                            value="bull"
                            class="custom-control-input"
                            {{ old('gender') === 'bull' ? "checked" : "" }}
                        />
                        <label class="custom-control-label" for="bull">Bull</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" 
                            id="cow"
                            value="cow"
                            name="gender" 
                            class="custom-control-input"
                            {{ old('gender') === 'cow' ? "checked" : "" }}
                        />
                        <label class="custom-control-label" for="cow">Cow</label>
                    </div>
                </div>
                <div class="form-group">
                    <select class="custom-select" name="pasture_id">
                        <option {{ old('pasture_id') === '' ? "selected" : ""}}>Choose Pasture</option>
                        @foreach($pastures as $pasture)
                            <option value="{{ $pasture->id }}" {{ old('pasture_id') === $pasture->id ? "selected" : ""}} >
                                {{ $pasture->name }}
                            </option>
                        @endforeach                        
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="age">Age</label>
                        <input type="number" 
                            class="form-control" 
                            id="age" 
                            name="age" 
                            placeholder="Cattle age in months"
                            value="{{ old('age') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="color">Color</label>
                        <input type="text" 
                            class="form-control" 
                            id="color" 
                            name="color" 
                            placeholder="Cattle color"
                            value="{{ old('color') }}"
                        />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="weight">Weight</label>
                        <input type="number" 
                            class="form-control" 
                            id="weight" 
                            name="weight" 
                            placeholder="Cattle weight"
                            value="{{ old('weight') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="price">Price</label>
                        <input type="number" 
                            class="form-control" 
                            id="price" 
                            name="price" 
                            placeholder="Cattle price"
                            value="{{ old('price') }}"
                        />
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
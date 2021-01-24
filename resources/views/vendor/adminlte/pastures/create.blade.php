@extends('adminlte::layouts.app')

@section('htmlheader_title')
    pastures
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <h1 class="h1 py-3">Add new Pasture</h1>
            <form action="{{ route('pastures.store') }}" method="POST">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-row mb-4">
                    <div class="col-md-6">                    
                        <label for="name">Name</label>
                        <input type="text" 
                            class="form-control" 
                            id="name" 
                            name="name" 
                            placeholder="name the pasture"
                            value="{{ old('name') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="temperature">Temperature</label>
                        <input type="number" 
                            class="form-control" 
                            id="temperature" 
                            name="temperature" 
                            placeholder="Temperature in fehrenhite"
                            value="{{ old('temperature') }}"
                        />
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-6">                    
                        <select class="custom-select" name="grass">
                            <option {{ old('grass') === '' ? "selected" : ""}}>Choose grass type</option>
                            <option value="short" {{ old('grass') === 'short' ? "selected" : ""}}>Short</option>
                            <option value="medium" {{ old('grass') === 'medium' ? "selected" : ""}}>Medium</option>
                            <option value="long" {{ old('grass') === 'long' ? "selected" : ""}}>Long</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="custom-select" name="weather">
                            <option {{ old('weather') === '' ? "selected" : ""}}>Choose weather condition</option>
                            <option value="dry" {{ old('weather') === 'dry' ? "selected" : ""}}>Dry</option>
                            <option value="windy" {{ old('weather') === 'windy' ? "selected" : ""}}>Windy</option>
                            <option value="rainy" {{ old('weather') === 'rainy' ? "selected" : ""}}>Rainy</option>
                            <option value="cool" {{ old('weather') === 'cool' ? "selected" : ""}}>Cool</option>
                            <option value="hot" {{ old('weather') === 'hot' ? "selected" : ""}}>Hot</option>
                            <option value="normal" {{ old('weather') === 'normal' ? "selected" : ""}}>Normal</option>
                        </select>
                    </div>
                </div>                
                <div class="form-row mb-4">
                    <div class="col-md-6">
                        <label for="bulls">Bulls</label>
                        <input type="number" 
                            class="form-control" 
                            id="bulls" 
                            name="bulls" 
                            placeholder="maximum number of bulls"
                            value="{{ old('bulls') }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="cows">Cows</label>
                        <input type="number" 
                            class="form-control" 
                            id="cows" 
                            name="cows" 
                            placeholder="maximum number of cows"
                            value="{{ old('cows') }}"
                        />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
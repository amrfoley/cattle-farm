@extends('adminlte::layouts.app')

@section('htmlheader_title')
    pastures
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <div class="py-3 d-flex align-items-center">
                <h1 class="h1 m-0 pr-3">Pasture: {{ $pasture->name }}</h1>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    Delete
                </button>
            </div>
            <form action="{{ route('pastures.update', $pasture->id) }}" method="POST">
                @csrf
                @method('patch')
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
                            value="{{ old('name') ?? $pasture->name }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="temperature">Temperature</label>
                        <input type="number" 
                            class="form-control" 
                            id="temperature" 
                            name="temperature" 
                            placeholder="Temperature in fehrenhite"
                            value="{{ old('temperature') ?? $pasture->temperature }}"
                        />
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-6">
                        <select class="custom-select" name="grass">                        
                            <option value="short" {{ old('grass') === 'short' || $pasture->grass === 'short' ? "selected" : '' }}>Short</option>
                            <option value="medium" {{ old('grass') === 'medium' || $pasture->grass === 'medium' ? "selected" : ''}}>Medium</option>
                            <option value="long" {{ old('grass') === 'long' || $pasture->grass === 'long' ? "selected" : ''}}>Long</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="custom-select" name="weather">
                            <option value="dry" {{ old('weather') === 'dry' || $pasture->weather === 'dry' ? "selected" : ""}}>Dry</option>
                            <option value="windy" {{ old('weather') === 'windy' || $pasture->weather === 'windy' ? "selected" : ""}}>Windy</option>
                            <option value="rainy" {{ old('weather') === 'rainy' || $pasture->weather === 'rainy' ? "selected" : ""}}>Rainy</option>
                            <option value="cool" {{ old('weather') === 'cool' || $pasture->weather === 'cool' ? "selected" : ""}}>Cool</option>
                            <option value="hot" {{ old('weather') === 'hot' || $pasture->weather === 'hot' ? "selected" : ""}}>Hot</option>
                            <option value="normal" {{ old('weather') === 'normal' || $pasture->weather === 'normal' ? "selected" : ""}}>Normal</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col-md-6 pl-0">
                        <label for="bulls">Bulls</label>
                        <input type="number" 
                            class="form-control" 
                            id="bulls" 
                            name="bulls" 
                            placeholder="maximum number of bulls"
                            value="{{ old('bulls') ?? $pasture->bulls }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="cows">Cows</label>
                        <input type="number" 
                            class="form-control" 
                            id="cows" 
                            name="cows" 
                            placeholder="maximum number of cows"
                            value="{{ old('cows') ?? $pasture->cows }}"
                        />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete pasture {{ $pasture->name }}
      </div>
      <div class="modal-footer">
        <form action="{{ route('pastures.destroy', $pasture->id) }}" method="POST">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
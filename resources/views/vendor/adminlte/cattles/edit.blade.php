@extends('adminlte::layouts.app')

@section('htmlheader_title')
    cattles
@endsection


@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <div class="py-3 d-flex align-items-center">
                <h1 class="h1 m-0 pr-3">Cattle: {{ $cattle->serial }}</h1>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                    Delete
                </button>
            </div>
            <form action="{{ route('cattles.update', $cattle->id) }}" method="POST">
                @csrf
                @method('patch')
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" 
                            id="bull"
                            name="gender"
                            value="bull"
                            class="custom-control-input"
                            {{ old('gender') === 'bull' || $cattle->gender === 'bull' ? "checked" : "" }}
                        />
                        <label class="custom-control-label" for="bull">Bull</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" 
                            id="cow"
                            value="cow"
                            name="gender" 
                            class="custom-control-input"
                            {{ old('gender') === 'cow' || $cattle->gender === 'cow' ? "checked" : "" }}
                        />
                        <label class="custom-control-label" for="cow">Cow</label>
                    </div>
                </div>
                <div class="form-group">
                    <select class="custom-select" name="pasture_id">    
                        @foreach($pastures as $pasture)
                        <option value="{{ $pasture->id }}" {{ old('pasture_id') === $pasture->id || $cattle->pasture[0]->id === $pasture->id ? "selected" : ""}} >
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
                            value="{{ old('age') ?? $cattle->age }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="color">Color</label>
                        <input type="text" 
                            class="form-control" 
                            id="color" 
                            name="color" 
                            placeholder="Cattle color"
                            value="{{ old('color') ?? $cattle->color }}"
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
                            value="{{ old('weight') ?? $cattle->weight }}"
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="price">Price</label>
                        <input type="number" 
                            class="form-control" 
                            id="price" 
                            name="price" 
                            placeholder="Cattle price"
                            value="{{ old('price') ?? $cattle->price }}"
                        />
                    </div>
                </div>
                <div class="py-3">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
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
        Are you sure you want to delete cattle {{ $cattle->serial }}
      </div>
      <div class="modal-footer">
        <form action="{{ route('cattles.destroy', $cattle->id) }}" method="POST">
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
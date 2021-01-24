@extends('adminlte::layouts.app')

@section('htmlheader_title')
    pastures
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
		<div class="row">
            <div class="py-3 d-flex align-items-center">
                <h1 class="h1 m-0 pr-3">All Pasture</h1>
                <a href="{{ route('pastures.create') }}" class="btn btn-success">Add</a>
            </div>
			<div class="col-md-12">
                @if($pastures->count() > 0)
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">Grass</th>
                            <th scope="col">Weather</th>
                            <th scope="col">Temperature</th>
                            <th scope="col">Bulls</th>
                            <th scope="col">Cows</th>
                            <th scope="col">existing</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pastures as $pasture)
                                <tr>
                                    <th scope="row">{{$pasture->id}}</th>
                                    <td>{{$pasture->name}}</td>
                                    <td>{{$pasture->grass}}</td>
                                    <td>{{$pasture->weather}}</td>
                                    <td>{{$pasture->temperature}}</td>
                                    <td>{{$pasture->bulls}}</td>
                                    <td>{{$pasture->cows}}</td>
                                    <td>{{$pasture->cattles_count}}</td>
                                    <td><a href="{{ route('pastures.edit', $pasture->id) }}" class="btn btn-primary">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $pastures->links() }}
                @endif
            </div>
		</div>
	</div>
@endsection
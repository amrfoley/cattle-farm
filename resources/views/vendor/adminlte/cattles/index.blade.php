@extends('adminlte::layouts.app')

@section('htmlheader_title')
    cattles
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
		<div class="row">
            <div class="py-3 d-flex align-items-center">
                <h1 class="h1 m-0 pr-3">All Cattles</h1>
                @if($pastures > 0)
                    <a href="{{ route('cattles.create') }}" class="btn btn-success">Add</a>
                @endif
            </div>
			<div class="col-md-12">
                @if($cattles->count() > 0)
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age(months)</th>
                            <th scope="col">Pasture</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Color</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cattles as $cattle)
                                <tr>
                                    <th scope="row">{{$cattle->id}}</th>
                                    <td>{{$cattle->serial}}</td>
                                    <td>{{$cattle->gender}}</td>
                                    <td>{{$cattle->age}}</td>
                                    <td>{{$cattle->pasture[0]->name}}</td>
                                    <td>{{$cattle->weight}}</td>
                                    <td>{{$cattle->color}}</td>
                                    <td>{{$cattle->price}}</td>
                                    <td><a href="{{ route('cattles.edit', $cattle->id) }}" class="btn btn-primary">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $cattles->links() }}
                @else
                    <a href="{{ route('pastures.create') }}" class="btn btn-lg btn-primary">Add Pasture First</a>
                @endif
            </div>
		</div>
	</div>
@endsection
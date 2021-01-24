@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Reports
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
		<div class="row">
            <div class="py-3 d-flex align-items-center">
                <h1 class="h1 m-0 pr-3">Last 30 Days Reports</h1>
                @if($pastures > 0)
                    <a href="{{ route('reports.create') }}" class="btn btn-success">Add</a>
                @endif
            </div>
			<div class="col-md-12">
                @if($pastures > 0)
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">Day</th>
                            <th scope="col">pasture</th>
                            <th scope="col">cattles</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                                <tr>
                                    {{$record}}
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <a href="{{ route('pastures.create') }}" class="btn btn-lg btn-primary">Add Pasture First</a>
                @endif
            </div>
		</div>
	</div>
@endsection
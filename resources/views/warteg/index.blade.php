
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>List Of Warteg</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('warteg.create') }}" class="btn btn-md btn-dark">Add Warteg</a>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Owner Name</th>
                        <th>Phone</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($warteg as $item)
                        <tr>
                            <td>
                                <a href="{{ route('warteg.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form class="d-inline" action="{{ route('warteg.destroy', $item->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button  type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->owner_name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->toFormattedDateString() }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Maaf tidak ada data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop



@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>List Of User</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-md btn-dark">Add User</a>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Username</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user as $item)
                        <tr>
                            <td>
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form class="d-inline" action="{{ route('user.destroy', $item->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button  type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>{{ $item->username }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}</td>
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



@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create User</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('user.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Username:</label>
                        <input class="form-control" id="username" name="username" type="text" placeholder="Enter a username here... " value="{{ old('username') }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control" id="password" name="password" type="password"  placeholder="Enter a password here... " required/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-md btn-primary" type="submit">Submit</button>
                    </div>
                </form>
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

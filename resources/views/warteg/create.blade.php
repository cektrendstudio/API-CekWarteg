
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create Warteg</h1>
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
                <form
                    enctype="multipart/form-data"
                    action="{{ route('warteg.store') }}"
                    method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input class="form-control" id="username" name="username" type="text" placeholder="Enter a username here... " value="{{ old('username') }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control" id="password" name="password" type="password"  placeholder="Enter a password here... " required/>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" id="name" name="name" type="text"  placeholder="Enter a name of warteg here... " required/>
                    </div>
                    <div class="form-group">
                        <label for="ownerName">Owner Name:</label>
                        <input class="form-control" id="ownerName" name="ownerName" type="text"  placeholder="Enter a name of owner warteg here... " required/>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter address of warteg here..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description of warteg here..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input class="form-control" id="phone" name="phone" type="number"  placeholder="Enter a number phone of warteg here... " required/>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input class="form-control" id="photo" name="photo" type="file" required/>
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

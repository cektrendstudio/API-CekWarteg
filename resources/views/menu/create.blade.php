
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create Menu</h1>
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
                <form enctype="multipart/form-data"
                      action="{{ route('menu.store') }}"
                      method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="warteg_id">Warteg:</label>
                        <select id="warteg_id" name="warteg_id" class="form-control" required>
                            <option required>Select...</option>
                            @forelse($warteg as $item)
                                <option value="{{ $item->id }}">{{ $item->code .' - '. $item->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_have_stock">Is Have Stock ?:</label>
                        <select id="is_have_stock" name="is_have_stock" class="form-control" required>
                            <option required>Select...</option>
                            <option value="0">Yes</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name of menu here..." required/>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" min="200" class="form-control" id="price" name="price" placeholder="Enter price of menu here..." required/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description of warteg here..." required></textarea>
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

@extends('layouts.mainlayout')

@section('title', 'Edit Departement')

@section('content')

    <h1>Edit Departement</h1>

    <div class="mt-5 w-50">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/depart-edit/{{$departo->slug}}" method="post">
            @csrf
            @method('put')
            <div>
                <label for="depart" class="form-label">Departement</label>
                <input type="text" name="depart" id="depart" class="form-control" value="{{$departo->depart}}" placeholder="Name of Departement">
            </div>

            <div class="mt-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>

@endsection

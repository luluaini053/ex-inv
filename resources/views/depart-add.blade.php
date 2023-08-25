@extends('layouts.mainlayout')

@section('title', 'Add Departement')

@section('content')

    <h1>Add Departement</h1>

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
        <form action="category-add" method="post">
            @csrf
            <div>
                <label for="depart" class="form-label">Nama Departement</label>
                <input type="text" name="depart" id="depart" class="form-control" placeholder="Departement Name">
            </div>

            <div class="mt-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>

@endsection

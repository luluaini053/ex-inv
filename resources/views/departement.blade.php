@extends('layouts.mainlayout')

@section('title', 'Departement')

@section('content')
<h1>Departement List</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="/depart-deleted" class="btn btn-secondary me-3">View Delete Departement</a>
    <a href="/depart-add" class="btn btn-primary">Add Departement</a>
</div>

<div class="mt-5">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>

<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Departement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($depart as $item)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $item->depart}}</td>
                <td>
                    <a href="/depart-edit/{{$item->slug}}">Edit</a>
                    <a href="/depart-delete/{{$item->slug}}">Delete</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>

@endsection

@extends('layouts.mainlayout')

@section('title', 'Deleted Departement')

@section('content')
<h1>Delete Departement List</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="/departement" class="btn btn-primary">Back</a>
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
            @foreach ($deletedDepart as $item)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $item->depart}}</td>
                <td>
                    <a href="/depart-restore/{{$item->slug}}">Restore</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>

@endsection

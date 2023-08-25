@extends('layouts.mainlayout')

@section('title', 'Delete Departement')

@section('content')
    <h2>Are you sure to delete {{$depart->depart}} ?</h2>
    <div class="mt-5">
        <a href="/depart-eliminate/{{$depart->slug}}" class="btn btn-danger me-4">Sure</a>
        <a href="/departement" class="btn btn-info">Cancel</a>
    </div>
@endsection

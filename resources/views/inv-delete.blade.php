@extends('layouts.mainlayout')

@section('title', 'Delete Item')

@section('content')
    <h2>Are you sure to delete {{$inv->title}} ?</h2>
    <div class="mt-5">
        <a href="/inv-eliminate/{{$inv->slug}}" class="btn btn-danger me-4">Sure</a>
        <a href="/inventory" class="btn btn-info">Cancel</a>
    </div>
@endsection

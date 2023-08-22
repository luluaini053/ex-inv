@extends('layouts.mainlayout')

@section('title', 'Banned User')

@section('content')
    <h2>Are you sure to Banned {{$user->username}} ?</h2>
    <div class="mt-5">
        <a href="/user-eliminate/{{$user->slug}}" class="btn btn-danger me-4">Sure</a>
        <a href="/users" class="btn btn-info">Cancel</a>
    </div>
@endsection

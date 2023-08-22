@extends('layouts.mainlayout')

@section('title', 'Delete Category')

@section('content')
    <h2>Are you sure to delete {{$cate->name}} ?</h2>
    <div class="mt-5">
        <a href="/category-eliminate/{{$cate->slug}}" class="btn btn-danger me-4">Sure</a>
        <a href="/categories" class="btn btn-info">Cancel</a>
    </div>
@endsection

@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')
    <h1>Detail User</h1>

    <div class="mt-5 d-flex justify-content-end">
        @if ($user->status == 'inactive')
            <a href="/user-approve/{{$user->slug}}" class="btn btn-info">Aprroved User</a>
        @endif

    </div>

    <div class="mt-5">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
    </div>

    <div class="my-5 w-50">
        <div class="mb-3">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" readonly value="{{$user->username}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Division</label>
            <input type="text" class="form-control" readonly value="{{$user->divisi}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" readonly value="{{$user->status}}">
        </div>
    </div>

    <div class="mt-5">
        <h1>#User Log#</h1>
        <x-inv-log-table :invlog='$inv_log' />
    </div>
@endsection

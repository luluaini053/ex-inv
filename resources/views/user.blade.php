@extends('layouts.mainlayout')

@section('title', 'User')

@section('content')
    <h1>User List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/user-banned-list" class="btn btn-secondary me-3">View Banned User</a>
        <a href="/registered-users" class="btn btn-primary">Registered New User</a>
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
                    <th>Username</th>
                    <th>Division</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->username}}</td>
                    <td>{{ $item->depart}} </td>
                    <td>
                        <a href="/user-detail/{{$item->slug}}">Detail</a>
                        <a href="/user-banned/{{$item->slug}}">Ban User</a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')
    <h1>New User List</h1>

    <div class="mt-5 d-flex justify-content-end">
            <a href="/users" class="btn btn-primary">Aprroved User List</a>
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
                @foreach ($registeredUsers as $user)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $user->username}}</td>
                        <td>{{ $user->depart->depart}}</td>
                    <td>
                        <a href="/user-detail/{{$user->slug}}">Detail</a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

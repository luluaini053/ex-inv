@extends('layouts.mainlayout')

@section('title', 'Deleted Category')

@section('content')
<h1>Delete Item List</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="/inventory" class="btn btn-primary">Back</a>
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
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deletedInv as $item)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $item->inv_code}}</td>
                <td>{{ $item->title}}</td>
                <td>
                    @foreach ($item->categories as $category)
                        {{$category->name}}
                    @endforeach
                </td>
                <td>
                    <a href="/inv-restore/{{$item->slug}}">Restore</a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>

@endsection

@extends('layouts.mainlayout')

@section('title', 'Inventory')

@section('content')
    <h1>Inventory List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="inv-deleted" class="btn btn-secondary me-3">View Delete Item</a>
        <a href="inv-add" class="btn btn-primary">Add Item</a>
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
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invens as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->inv_code}}</td>
                    <td>{{ $item->title}}</td>
                    <td>
                        @foreach ($item->categories as $category)
                            {{$category->name}}
                        @endforeach
                    </td>
                    <td>{{ $item->stock}}</td>
                    <td>{{ $item->status}}</td>
                    <td>
                        <a href="/inv-edit/{{$item->slug}}">Edit</a>
                        <a href="/inv-delete/{{$item->slug}}">Delete</a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

@endsection

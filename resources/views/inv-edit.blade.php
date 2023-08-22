@extends('layouts.mainlayout')

@section('title', 'Edit Item')

@section('content')

    <h1>Edit Item</h1>

    <div class="mt-5 w-50">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/inv-edit/{{$inv->slug}}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="inv_code" id="code" class="form-control" placeholder="Item Code" value="{{ $inv->inv_code }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Item Name" value="{{ $inv->title }}">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach ($cate as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="currentCategory" class="form-label">Current Category</label>
                <ul>
                    @foreach ($inv->categories as $cate)
                        <li>{{$cate->name}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" name="stock" id="stock" class="form-control" placeholder="Item Stock" value="{{ old('stock') }}">
            </div>

            <div class="mt-3">
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>

@endsection

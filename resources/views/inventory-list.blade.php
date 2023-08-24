@extends('layouts.mainlayout')

@section('title', 'Inventory List')

@section('content')

    <form action="" method="get">
        <div class="row">
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($cate as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Item Name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>

    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invs as $item)
                <tr>
                    <td>{{$item->inv_code}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->status}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

@endsection

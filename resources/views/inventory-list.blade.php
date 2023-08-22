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

    <div class="my-5" >
        <div class="row">

            @foreach ($invs as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->inv_code}}</h5>
                            <p class="card-text">{{$item->title}}</p>
                            <p class="card-text text-end">{{$item->stock}}</p>
                            <p class="card-text text-end fw-bold {{$item->status == 'in stock' ? 'text-success' : 'text-danger'}}">
                                {{$item->status}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

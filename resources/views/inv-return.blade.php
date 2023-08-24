@extends('layouts.mainlayout')

@section('title', 'Inventory Return')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="row">
        <div class="col-4">
            <h1 class="mb-5">Receipt</h1>
            <div class="my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Divisi</th>
                            <th>Name</th>
                            <th>Item</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $item->divisi}}</td>
                            <td>{{ $item->username}} </td>
                            <td>{{ $item->title}}</td>
                            <td>
                                <button type="submit" class="btn btn-success">Add</button>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-8">
            <div class="col-12 col-md-8 col-md offset-md-2 col-lg-6 offset-md-3">
                <h1 class="mb-5">Pengembalian Barang</h1>

            <div class="mt-5">
                @if (session('message'))
                <div class="alert {{session('alert-class')}}">
                    {{ session('message') }}
                </div>
                @endif
            </div>
                <form action="inv-return" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user" class="form-label">User | Division</label>
                        <select name="user_id" id="user" class="form-control inputinv">
                            <option value="">Select User</option>
                            @foreach ($users as $item)
                                <option value="{{$item->id}}">{{$item->username}} | {{$item->divisi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inv" class="form-label">Item</label>
                        <select name="inv_id" id="inv" class="form-control inputinv">
                            <option value="">Select Item</option>
                            @foreach ($inv as $item)
                                <option value="{{$item->id}}">{{$item->inv_code}} {{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Qty</label>
                        <input type="number" id="stock" name="stock" class="form-control" min='0'/>
                    </div>

                    <div class="mb-3">
                        <label for="user" class="form-label">Kondisi barang</label>
                        <input type="text" name="user" id="user" class="form-control">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Return Item</button>
                    </div>
                </form>
            </div>
        </div>

    </div>



<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.inputinv').select2();
});
</script>

@endsection

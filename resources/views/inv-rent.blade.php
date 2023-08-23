@extends('layouts.mainlayout')

@section('title', 'Peminjaman Barang')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="col-12 col-md-8 col-md offset-md-2 col-lg-6 offset-md-3">
        <h1 class="mb-5">Rent Form</h1>

        <div class="mt-5">
            @if (session('message'))
            <div class="alert {{session('alert-class')}}">
                {{ session('message') }}
            </div>
            @endif
        </div>

        <form action="inv-rent" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" id="user" class="form-control inputinv">
                    <option value="">Select User</option>
                    @foreach ($users as $item)
                        <option value="{{$item->id}}">{{$item->username}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="inv" class="form-label">Item</label>
                <select name="inv_id" id="inv" class="form-control inputinv">
                    <option value="">Select Item</option>
                    @foreach ($inv as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="divisi" class="form-label">Division</label>
                <select name="divisi" id="divisi" class="form-control inputinv">
                    <option value="">Select Division</option>
                    @foreach ($users as $item)
                        <option value="{{$item->username}}">{{$item->divisi}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Qty</label>
                <input type="number" id="stock" name="stock" class="form-control" min='0'/>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">Rent</button>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.inputinv').select2();
});
</script>

@endsection

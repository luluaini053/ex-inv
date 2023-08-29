@extends('layouts.mainlayout')

@section('title', 'Inventory Return')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="row">
        <div class="col-4">
            <h1 class="mb-5">Daftar Barang</h1>
            <div class="my-5">
                <form action="inv-return" method="post">
                    @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Divisi</th>
                                    <th>Name</th>
                                    <th>Item</th>
                                    <th>Rented Qty</th>
                                    <th>Return Qty</th>
                                    {{-- <th>Qty</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invs as $inv)
                                    <tr>
                                        <td>{{ $inv->inv->inv_code  }}</td>
                                        <td>{{ $inv->depart ? $inv->depart->depart : 'N/A' }}</td>
                                        <td>{{ $inv->nickname}}</td>
                                        <td>{{ $inv->inv->title  }}</td>
                                        <td>{{ $inv->stock  }}</td>
                                        <td colspan="2">
                                            {{-- <div class="form-group mx-sm-3 mb-2"> --}}
                                                <input type="number" class="form-control" name="qty{{ $inv->id }}" id="qty{{ $inv->id }}" placeholder="qty">
                                            {{-- </div> --}}
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
                            {{-- <div class="mb-3">
                                <label for="depart" class="form-label">Division</label>
                                <select name="departs[]" id="depart" class="form-control inputinv">
                                    <option value="">Select depart</option>
                                    @foreach ($depart as $item)
                                        <option value="{{$item->id}}">{{$item->depart}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="mb-3">
                                <label for="user" class="form-label">Pengembali</label>
                                <input type="text" name="nickname" id="nickname" class="form-control">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="stock" class="form-label">Qty</label>
                                <input type="number" id="stock" name="stock" class="form-control" min='0'/>
                            </div> --}}
                            <div class="mb-3">
                                <label for="user" class="form-label">Keterangan barang</label>
                                <input type="text" name="condition" id="condition" class="form-control">
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

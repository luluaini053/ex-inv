@extends('layouts.mainlayout')

@section('title', 'Inventory Return')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="row">
        <div class="col-4">
            <h1 class="mb-5">Daftar Barang</h1>
            <div class="my-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Divisi</th>
                            <th>Name</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>return qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>IN-001</td>
                            <td>KNITTING</td>
                            <td>kenji</td>
                            <td>mouse</td>
                            <td>10</td>
                            <td colspan="4">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="number" class="form-control" id="qty" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Add</button>
                            </td>
                        </tr>
                        <tr>
                            <td>IN-002</td>
                            <td>garmen</td>
                            <td>kara</td>
                            <td>cpu</td>
                            <td>3</td>
                            <td colspan="4">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="number" class="form-control" id="qty" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Add</button>
                            </td>
                        </tr>
                        <tr>
                            <td>IN-003</td>
                            <td>hunter</td>
                            <td>shin</td>
                            <td>router</td>
                            <td>9</td>
                            <td colspan="4">
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="number" class="form-control" id="qty" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Add</button>
                            </td>
                        </tr>
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
                        <label for="user" class="form-label">Division</label>
                        <select name="user_id" id="user" class="form-control inputinv">
                            <option value="">Select User</option>
                            @foreach ($users as $item)
                                <option value="{{$item->id}}">{{$item->username}} | {{$item->divisi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">User</label>
                        <input type="text" name="user" id="user" class="form-control">
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

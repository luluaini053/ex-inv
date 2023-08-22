@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
<h1>Welcome, {{Auth::user()->username}}</h1>

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card-data inventory">
                <div class="row">
                    <div class="col-6"><i class="bi bi-boxes"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card-desc">Inventory</div>
                        <div class="card-qty">{{$inv_qty}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list-task"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card-desc">Categories</div>
                        <div class="card-qty">{{$cate_qty}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data user">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people-fill"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <div class="card-desc">Users</div>
                        <div class="card-qty">{{$user_qty}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h1>#Inventory Log#</h1>
        <x-inv-log-table :invlog='$inv_log' />
    </div>

@endsection

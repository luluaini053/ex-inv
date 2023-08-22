@extends('layouts.mainlayout')

@section('title', 'Inventory Log')

@section('content')
<h1>Inventory Rent Log</h1>
    <div class="mt-5">
        <x-inv-log-table :invlog='$inv_log' />
    </div>
@endsection

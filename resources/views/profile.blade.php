@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')

    <div class="mt-5">
        <h1>#Your Log#</h1>
        <x-inv-log-table :invlog='$inv_log' />
    </div>

@endsection

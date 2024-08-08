@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booster Packs</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row">
        @foreach($boosters as $booster)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booster->name }}</h5>
                        <p class="card-text">{{ $booster->type }}: {{ $booster->value }}</p>
                        <p class="card-text">Price: {{ $booster->price }} USDT</p>
                        <form method="POST" action="{{ route('boosters.purchase') }}">
                            @csrf
                            <input type="hidden" name="booster_id" value="{{ $booster->id }}">
                            <button type="submit" class="btn btn-primary">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

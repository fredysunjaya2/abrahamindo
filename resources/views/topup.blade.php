@extends('master')

@section('title', 'Home')

@section('activeTopup', 'active')

@section('content')
<div class="row row-cols-1 row-cols-2 g-4 col-6 mx-auto mt-5">
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title text-center">100 Coins</h5>
            </div>
            <form method="POST" action="{{ route('topup') }}" class="card-footer d-flex justify-content-center">
                @csrf
                <input type="hidden" value="100" name="coin">
                <button type="submit" class="btn btn-primary">Buy</button>
            </form>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">200 Coins</h5>
            </div>
            <form method="POST" action="{{ route('topup') }}" class="card-footer d-flex justify-content-center">
                @csrf
                <input type="hidden" value="200" name="coin">
                <button type="submit" class="btn btn-primary">Buy</button>
            </form>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">500 Coins</h5>
            </div>
            <form method="POST" action="{{ route('topup') }}" class="card-footer d-flex justify-content-center">
                @csrf
                <input type="hidden" value="500" name="coin">
                <button type="submit" class="btn btn-primary">Buy</button>
            </form>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">1000 Coins</h5>
            </div>
            <form method="POST" action="{{ route('topup') }}" class="card-footer d-flex justify-content-center">
                @csrf
                <input type="hidden" value="1000" name="coin">
                <button type="submit" class="btn btn-primary">Buy</button>
            </form>
        </div>
    </div>
</div>
@endsection
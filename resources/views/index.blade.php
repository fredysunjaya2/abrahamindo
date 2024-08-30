@extends('master')

@section('title', 'Home')

@section('activeHome', 'active')

@section('content')
<div class="row row-cols-2 row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 g-5 mt-2">
    @foreach ($games as $item)
    <a class="col" href="{{ route('game-details', $item->id) }}" style="text-decoration: none">
        <div class="card h-100">
            <img src="{{ asset('assets/game/' . $item->games_pic) }}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title">{{ $item->name }}</h5>
                <h6 class="card-text">{{ $item->genre->name }}</h6>
                <div class="d-flex flex-row justify-content-between">
                    <p class="card-text">Rating: {{ $item->rating }}</p>
                    <p class="card-text">Price: Rp{{ $item->price }}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
{{ $games->links() }}
@endsection

@extends('master')

@section('title', 'Home')

@section('content')
<div class="row row-cols-2 row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 g-5 mt-2">
    @foreach ($userGames as $item)
    <a class="col", href="{{ route('game-details', $item->id) }}">
        <div class="card h-100">
            <img src="{{ asset('assets/game/' . $item->game->games_pic) }}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title">{{ $item->game->name }}</h5>
                <div class="d-flex flex-row justify-content-between">
                    <p class="card-text">Rating: {{ $item->game->rating }}</p>
                    <p class="card-text">Price: Rp{{ $item->game->price }}</p>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
{{ $userGames->links() }}
@endsection

@extends('master')

@section('title', $game->name)

@section('content')
<div class="d-flex flex-column align-items-center px-3">
    <img src="{{ asset('assets/game/' . $game->games_pic) }}" class="card-img-top w-25" alt="...">
    <h1>{{ $game->name }}</h1>
    <p>{{ $game->desc }}</p>
    <p>Price: {{ $game->price }}</p>
    <p>Rating: {{ $game->rating }}</p>
    <p>Genre: {{ $game->genre->name }}</p>
    <div class="d-flex flex-row gap-3 align-items-center">
        <form action="{{ route('buy-game') }}" method="POST">
            @csrf
            <input type="hidden" name="game_id" value="{{ $game->id }}"></input>
            <button class="btn btn-primary" type="submit">Buy For Me</button>
        </form>
        <form action="{{ route('gift-game') }}" method="POST" class="d-flex flex-column align-items-center">
            @csrf
            <label for="friend">Friend: </label>
            <select id="friend" name="friend">
                @foreach($friends as $item)
                <option value="{{ $item->friend->id }}">{{ $item->friend->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="game_id" value="{{ $game->id }}"></input>
            <button class="btn btn-secondary" type="submit">Buy For Friends</button>
        </form>
    </div>
</div>
@endsection

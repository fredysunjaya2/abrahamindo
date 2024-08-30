@extends('master')

@section('title', 'Buy Game')

@section('content')
<div class="d-flex flex-column align-items-center px-3">
    <img src="{{ asset('assets/game/' . $userGame->game->games_pic) }}" class="card-img-top w-25" alt="...">
    <h1>{{ $userGame->game->name }}</h1>
    <p>{{ $userGame->game->desc }}</p>
    <p>Price: {{ $userGame->game->price }}</p>
    <p>Rating: {{ $userGame->game->rating }}</p>
    <p>Genre: {{ $userGame->game->genre->name }}</p>
    <div class="d-flex flex-row gap-3">
        <form action="{{ route('buy-game') }}" method="POST">
            @csrf
            <input type="hidden" name="game_id" value="{{ $userGame->game->id }}"></input>
            <button class="btn btn-primary" type="submit">Buy For Me</button>
        </form>
        <form action="{{ route('gift-game') }}" method="POST">
            @csrf
            <input type="hidden" name="game_id" value="{{ $userGame->game->id }}"></input>
            <button class="btn btn-secondary" type="submit">Buy For Friends</button>
        </form>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary invisible" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
    id="popup-btn">
    Launch static backdrop modal
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($status == 'already')
                <p class="modal-body-text">You've Already Purchased This Game Before</p>
                @elseif($status == 'done')
                <p class="modal-body-text">Thank You for Purchasing This Game</p>
                @endif
            </div>
            <div class="modal-footer">
                @csrf
                <label for="friend">Friend: </label>
                <select id="friend" name="friend">
                    @foreach($friends as $item)
                    <option value="{{ $item->friend->id }}">{{ $item->friend->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="game_id" value="{{ $game->id }}"></input>
                <button class="btn btn-secondary" type="submit">Buy For Friends</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#popup-btn').click();
    })
</script>

@endsection
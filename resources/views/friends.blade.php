@extends('master')

@section('title', 'Friends')

@section('activeFriends', 'active')

@section('content')
<form class="d-flex" role="search" action="{{ route('friends') }}">
    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<div class="row row-cols-2 row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 g-5 mt-2">
    @foreach ($friends as $item)
    <div class="col">
        <div class="card h-100">
            @if ($item->user_id == Auth::user()->id)
            <img src="{{ asset($item->friend->profile_pic) }}" class="card-img-top" alt="...">
            @else
            <img src="{{ asset($item->user->profile_pic) }}" class="card-img-top" alt="...">
            @endif
            <div class="card-body d-flex flex-column justify-content-between">
                @if ($item->user_id == Auth::user()->id)
                <h5 class="card-title">{{ $item->friend->name }}</h5>
                @else
                <h5 class="card-title">{{ $item->user->name }}</h5>
                @endif
                @if ($item->status == 'accepted')
                <div class="d-flex flex-row justify-content-end">
                    <form method="POST" action="{{ route('remove-friend') }}" class="col">
                        @csrf
                        <input type="hidden" value="{{ $item->friend_id }}" name="friend_id">
                        <button type="submit" class="btn btn-secondary">Remove Friend</button>
                    </form>
                    <a href="{{ route('message', $item->friend_id) }}" class="btn btn-primary">Message</a>
                </div>
                @elseif ($item->status == 'pending' && $item->user_id == Auth::user()->id)
                <h6 class="card-text">Your Friend Request is in Pending</h6>
                @elseif ($item->status == 'pending' && $item->friend_id == Auth::user()->id)
                <h6 class="card-text">You have incoming friend request</h6>
                <div class="row">
                    <form method="POST" action="{{ route('accept-friend') }}" class="col">
                        @csrf
                        <input type="hidden" value="{{ $item->user_id }}" name="friend_id">
                        <button type="submit" class="btn btn-primary">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('accept-friend') }}" class="col">
                        @csrf
                        <input type="hidden" value="{{ $item->friend_id }}" name="friend_id">
                        <button type="submit" class="btn btn-secondary">Decline</button>
                    </form>
                </div>
                @else
                <form>
                    @csrf
                    <button type="submit" class="btn btn-primary">Add Friend</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $friends->links() }}
@endsection

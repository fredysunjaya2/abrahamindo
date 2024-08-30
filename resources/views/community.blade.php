@extends('master')

@section('title', 'Community')

@section('activeCommunity', 'active')

@section('content')
<form class="d-flex" role="search" action="{{ route('community') }}">
    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<div class="row row-cols-2 row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 g-5 mt-2">
    @foreach ($friends as $item)
    <div class="col">
        <div class="card h-100">
            <img src="{{ asset($item->profile_pic) }}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column justify-content-between">
                <h5 class="card-title">{{ $item->name }}</h5>
            </div>
            <form class="card-footer d-flex justify-content-end" action="{{ route('add-friend') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $item->id }}" name="friend_id">
                <button type="submit" class="btn btn-primary">Add Friend</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
{{ $friends->links() }}
@endsection

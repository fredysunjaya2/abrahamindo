@extends('master')

@section('title', 'Community')

@section('content')
<div class="col-8 border border-primary rounded mx-auto" style="height:75vh; margin-top: 2rem">
    @foreach ($messages as $item)
    @if ($item->sender_id == Auth::id())
    <div class="col d-flex justify-content-end p-3 m-3 ms-auto bg-primary text-white rounded col-4">
        <p>{{ $item->message }}</p>
    </div>
    @else
    <div class="col d-flex justify-content-start p-3 m-3 me-auto bg-primary text-white rounded col-4">
        <p>{{ $item->message }}</p>
    </div>
    @endif
    @endforeach
</div>

<form class="col-8 row border border-primary rounded mx-auto mt-2" method="POST" action="{{ route('send-message') }}">
    @csrf
    <input type="hidden" name="receiver_id" value="{{ $id }}">
    <input type="text" class="col" name="message">
    <button type="submit" class="btn btn-primary col-1">Send</button>
</form>
@endsection
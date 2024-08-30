@extends('master')

@section('title', 'Profile')

@section('activeProfile', 'active')

@section('content')
<form method="POST" action="{{ route('update-profile') }}" class="row mx-auto px-5" enctype="multipart/form-data">
    @csrf

    <img src="{{ asset(Auth::user()->profile_pic) }}" alt="..." style="height: 30vh;" class="object-fit-contain">

    <!-- Name -->
    <label for="name">Name: </label>
    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">

    <!-- Email Address -->
    <label for="email">Email: </label>
    <input type="text" name="email" id="email" value="{{ Auth::user()->email }}">

    <label for="password">Password: </label>
    <input type="password" name="password" id="password">

    <label for="profile_pic">Profile Pic</label>
    <input type="file" name="profile_pic" id="profile_pic">

    <button type="submit" class="btn btn-primary">Update</button>

</form>

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
                <p class="modal-body-text">You're password is wrong</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('profile') }}" class="btn btn-primary">OK</a>
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

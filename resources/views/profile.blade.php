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
@endsection

@section('script')
@if(isset($status))
<script>
    var status = {{ $status }}
    if(status != null) {
        alert('asd')
    } else {
        alert('def')
    }
</script>
@endif
@endsection
<nav class="navbar sticky-top navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="40" height="40"
                class="d-inline-block align-text-top">
            AbrahamIndo
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('my-game') }}">My Game</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown link
                    </a>
                </li>
            </ul>
        </div>
        @if (!Auth::check())
        <div class="ms-auto d-flex flex-row me-5 gap-3">
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        </div>
        @else
        <div class="ms-auto d-flex flex-row me-5 gap-3">
            <p class="fs-5 text-danger mb-0">Coin: {{ Auth::user()->coin }}</p>
        </div>
        @endif
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</nav>

@extends('app')

@section('content')

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">FGJEZ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @if (Auth::user()->type == 0)
                <li class="nav-item">
                    <a class="nav-link" href="/personales">Datos personales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/extravio">Extravios</a>
                </li>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/revision">Revision</a>
                </li>
            @endif
            
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <a class="nav-link" onClick="this.closest('form').submit()" style="cursor: pointer">Logout</a>
                </form>
            </li>
        </ul>
        </div>
    </div>
</nav>

@yield('content-2')
    
@endsection
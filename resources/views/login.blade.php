@extends('app')

@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('signin') }}" method="POST">
        @csrf

        @if (session('correcto'))
            <h6 class="alert alert-success">{{ session('correcto') }}</h6>
        @endif

        @error('error')
            <h6 class="alert alert-danger">{{ $message }}</h6>
            
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{ old('email') }}" autofocus type="email" class="form-control" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <input type="checkbox" class="form-check-input" name="recuerdame">
            <label for="recuerdame" class="form-label">Recuerdame</label>
        </div>
        <button type="submit" class="btn btn-primary">Acceder</button>
    </form>

    <div class="mt-3">
        <a href="{{ route('signup') }}">¿No tienes usuario?</a>
    </div>
</div>

@endsection
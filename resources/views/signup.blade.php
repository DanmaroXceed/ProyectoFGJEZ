@extends('app')

@section('content')
<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('signup-store') }}" method="POST">
        @csrf
            
        @error('name')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('email')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('password')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('confirm_password')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input value="{{ old('name') }}" type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="{{ old('email') }}" type="email" class="form-control" name="email">
        </div> 
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input value="{{ old('password') }}" type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="confirm_password">
        </div>
        <button type="submit" class="btn btn-primary">Generar Usuario</button>
    </form>

    <div class="mt-3">
        <a href="{{ route('login') }}">Iniciar sesion</a>
    </div>
</div>

@endsection
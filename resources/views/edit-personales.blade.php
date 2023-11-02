@extends('home')

@section('content-2')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('personales-update', ['id' => $personal -> id]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
                
            @error('address')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('brtDay')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('gen')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            @error('file')
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <div class="mb-3">
                <label for="address" class="form-label">Direccion</label>
                <input value="{{ $personal->address }}" type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label for="brtDay" class="form-label">Fecha de nacimiento</label>
                <input value="{{ $personal->brtDay }}" type="date" class="form-control" name="brtDay">
            </div> 
            <div class="mb-3">
                <label class="form-label" for="gen">Genero</label>
                <select name="gen" class="form-select">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="X">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Comprobante (INE, Pasaporte, Cartilla militar, etc.)</label>
                <input type="file" class="form-control" name="file" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
@extends('home')

@section('content-2')
    @if ($personal -> count() > 0)
        @if (session('correcto'))
            <h6 class="alert alert-success w-25 border p-4 mt-4 container">{{ session('correcto') }}</h6>
        @endif
        <div class="container w-50 border p-4 mt-4">
            <div class="mb-3">
                <h4 for="" class="form-label">Direccion: {{ $personal[0]->address}}</h4>
                <h4 for="" class="form-label">Fecha de nacimiento: {{ $personal[0]->brtDay}}</h4>
                <h4 for="" class="form-label">Genero: {{ $personal[0]->gen}}</h4>
                <h4 for="" class="form-label">Archivo: <a class='btn btn-outline-success btn-sm' href="{{url('storage/' . $personal[0]->file)}}" target="_blank" enctype="multipart/form-data">
                    Ver documento</a></h4>
            </div>
            <div>
                @if ( $personal[0]->verif == 0)
                    <a href="{{  route('personales-edit', ['id' => $personal[0]->id]) }}" class="btn btn-outline-primary">Editar</a>
                @endif
            </div>
        </div>

    @else
    <div class="container w-25 border p-4 mt-4">
        <form action="{{route('gen-personales')}}" method="POST" enctype="multipart/form-data">
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
                <input value="{{ old('address') }}" type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label for="brtDay" class="form-label">Fecha de nacimiento</label>
                <input value="{{ old('brtDay') }}" type="date" class="form-control" name="brtDay">
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
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    @endif
@endsection
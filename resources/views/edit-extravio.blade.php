@extends('home')

@section('content-2')
    <div class="container w-25 border p-4 mt-4">
    <form action="{{ route('extravio-update', ['id' => $extravio -> id]) }}" method="POST">
        @method('PATCH')
        @csrf
            
        @error('nameDoc')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('docDesc')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('date')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('place')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror
        @error('escDesc')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        @if (session('correcto'))
            <h6 class="alert alert-success">{{ session('correcto') }}</h6>
        @endif
        <div class="mb-3">
            <label for="nameDoc" class="form-label">Nombre del objeto o documento</label>
            <input value="{{ $extravio->nameDoc }}" type="text" class="form-control" name="nameDoc">
        </div>
        <div class="mb-3">
            <label for="docDesc" class="form-label">Descripcion</label>
            <input value="{{ $extravio->docDesc }}" type="text" class="form-control" name="docDesc">
        </div> 
        <div class="mb-3">
            <label for="date" class="form-label">Fecha de extravio</label>
            <input value="{{ $extravio->date }}" type="date" class="form-control" name="date">
        </div>
        <div class="mb-3">
            <label for="place" class="form-label">Lugar del extravio</label>
            <input value="{{ $extravio->place }}" type="text" class="form-control" name="place">
        </div>
        <div class="mb-3">
            <label for="escDesc" class="form-label">Descripcion del suceso</label>
            <input value="{{ $extravio->escDesc }}" type="text" class="form-control" name="escDesc">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Reporte</button>
    </form>
</div>
@endsection
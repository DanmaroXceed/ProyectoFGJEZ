@extends('home')

@section('content-2')
<div class="container w-25 border p-4 mt-4">
    <form action="{{route('gen-report')}}" method="POST">
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
            <input value="{{ old('nameDoc') }}" type="text" class="form-control" name="nameDoc">
        </div>
        <div class="mb-3">
            <label for="docDesc" class="form-label">Descripcion</label>
            <input value="{{ old('docDesc') }}" type="text" class="form-control" name="docDesc">
        </div> 
        <div class="mb-3">
            <label for="date" class="form-label">Fecha de extravio</label>
            <input value="{{ old('date') }}" type="date" class="form-control" name="date">
        </div>
        <div class="mb-3">
            <label for="place" class="form-label">Lugar del extravio</label>
            <input value="{{ old('place') }}" type="text" class="form-control" name="place">
        </div>
        <div class="mb-3">
            <label for="escDesc" class="form-label">Descripcion del suceso</label>
            <input value="{{ old('escDesc') }}" type="text" class="form-control" name="escDesc">
        </div>
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
</div>

<div class="container w-50 border p-4 mt-4">
    @if ($extravios -> count() > 0)
        @foreach ($extravios as $extravio)
            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $extravio->id }}" aria-controls="collapse{{ $extravio->id }}">
                            Reporte: {{ $extravio->nameDoc }}
                        </button>
                    </h2>
                    <div id="collapse{{ $extravio->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <h4>Nombre del objeto o documento: {{ $extravio->nameDoc }}</h4>
                            <h5>Descripcion: {{ $extravio->docDesc }}</h5>
                            <h5>Fecha de extravio: {{ $extravio->date }}</h5>
                            <h5>Lugar de extravio: {{ $extravio->place }}</h5>
                            <h5>Descripcion del suceso: {{ $extravio->escDesc }}</h5>
                            @if ($extravio->verif == 0)
                                <a class="btn btn-outline-primary" href="{{  route('extravio-edit', ['id' => $extravio->id]) }}">Editar</a>
        
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$extravio->id}}">Eliminar</button>
                            @endif
                            

                            <!-- Modal -->
                            <div class="modal fade" id="modal-{{$extravio->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>¿Está seguro que desea eliminar el Reporte?</h6>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form method="POST" action="{{ route('extravio-destroy', [$extravio -> id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div>
        <h3>No hay reportes</h3>
    </div>
    @endif
    
</div>    
@endsection
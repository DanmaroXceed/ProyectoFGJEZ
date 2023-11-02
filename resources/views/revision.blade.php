@extends('home')

@section('content-2')
    @if (session('correcto'))
        <h6 class="alert alert-success w-25 border p-4 mt-4 container">{{ session('correcto') }}</h6>
    @endif
    <div class="container w-50 border p-4 mt-4">
    @if ($users -> count() > 0)
        @foreach ($users as $user)
            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $user->id }}" aria-controls="collapse{{ $user->id }}">
                            Usuario: {{ $user['name'] }} | Email: {{ $user->email }}
                        </button>
                    </h2>
                    <div id="collapse{{ $user->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <h5>Direccion: {{ $user->address}}</h5>
                            <h5>Fecha de nacimiento: {{ $user->brtDay}}</h5>
                            <h5>Genero: {{ $user->gen}}</h5>
                            <h5>Comprobante:<a href="{{url('storage/' . $user->file)}}" target="_blank"> {{ $user->file}}</a></h5>

                            @if ($user->verif == 0)
                            <form action="{{route('verificar', ['id' => $user->id])}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-success">Validar</button>
                                <a href="#" class="btn btn-danger float">Correccion</a>
                            </form>
                            @else
                                <a href="{{route('view-reports', ['id' => $user->id])}}" class="btn btn-outline-primary">Ver Reportes</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div>
        <h3>No hay Usuarios</h3>
    </div>
    @endif
    
</div>    
@endsection
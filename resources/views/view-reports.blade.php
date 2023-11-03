@extends('home')

@section('content-2')
    @if (session('correcto'))
        <h6 class="alert alert-success w-25 border p-4 mt-4 container">{{ session('correcto') }}</h6>
    @endif
    <div class="container w-50 border p-4 mt-4">
    @if ($reports -> count() > 0)
        @foreach ($reports as $report)
            <div class="accordion" id="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $report->id }}" aria-controls="collapse{{ $report->id }}">
                            Objeto: {{ $report->nameDoc }}
                        </button>
                    </h2>
                    <div id="collapse{{ $report->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body">
                            <h5>Descripcion del objeto: {{ $report->docDesc}}</h5>
                            <h5>Fecha: {{ $report->date}}</h5>
                            <h5>Lugar: {{ $report->place}}</h5>
                            <h5>Descripcion del suceso:{{ $report->escDesc}}</h5>

                            @if ($report->verif == 0)
                            <form action="{{route('verif-report', ['id' => $report->id])}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="btn btn-success">Validar</button>
                                <a href="#" class="btn btn-danger float">Correccion</a>
                            </form>
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
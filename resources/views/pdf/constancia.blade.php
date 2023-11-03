@extends('app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center">Constancia de Suceso</h1>
                </div>
                <div class="card-body">
                    <p><strong>Nombre del afectado:</strong> {{ $data[0]->name }}</p>
                    <p><strong>Correo electrónico de contacto:</strong> {{ $data[0]->email }}</p>
                    <p><strong>Dirección:</strong> {{ $data[0]->address }}</p>
                    <p><strong>Fecha de nacimiento:</strong> {{ $data[0]->brtDay }}</p>
                    <p><strong>Género:</strong> {{ $data[0]->gen }}</p>
                    <p><strong>Nombre del objeto extraviado:</strong> {{ $data[0]->nameDoc }}</p>
                    <p><strong>Descripción del objeto:</strong> {{ $data[0]->docDesc }}</p>
                    <p><strong>Fecha de extravío:</strong> {{ $data[0]->date }}</p>
                    <p><strong>Lugar del suceso:</strong> {{ $data[0]->place }}</p>
                    <p><strong>Descripción del suceso:</strong> {{ $data[0]->escDesc }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
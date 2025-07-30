@extends('layouts.app') {{-- Asegúrate de que 'layouts.app' sea el nombre de tu plantilla base --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Tareas</div>

                <div class="card-body">
                    <form action="/tareas" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="titulo" class="form-control" placeholder="Nueva tarea" aria-label="Nueva tarea">
                            <button class="btn btn-outline-secondary" type="submit">Agregar</button>
                        </div>
                    </form>

                    @if($tareas->count())
                        <ul class="list-group mt-3">
                        @foreach($tareas as $tarea)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $tarea->titulo }}
                                <div>
                                    <a href="/tareas/{{ $tarea->id }}/edit" class="btn btn-sm btn-warning me-2">Editar</a>
                                    <form action="/tareas/{{ $tarea->id }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    @else
                        <p class="text-muted mt-3">No hay tareas creadas aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<h1>Lista de Tareas</h1>

<form action="/tareas" method="POST">
    @csrf
    <input type="text" name="titulo" placeholder="Nueva tarea">
    <button type="submit">Agregar</button>
</form>

<ul>
@foreach($tareas as $tarea)
    <li>
        {{ $tarea->titulo }} -
        <a href="/tareas/{{ $tarea->id }}/edit">Editar</a>
        <form action="/tareas/{{ $tarea->id }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </li>
@endforeach
</ul>

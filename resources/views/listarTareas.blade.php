@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Listado de tareas</h3>
    <a href="{!!miUrl("listarTareas/uncompleted")!!}">Listar Tareas Incompletas</a><br><br>
    <table border="1" style="border-collapse: collapse">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Detalles</th>
                <th>Modificar</th>
                @if ($_SESSION['status'] == 'A')
                    <th>Eliminar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task['task_id'] }}</td>
                    <td>{{ $task['nombre'] }}</td>
                    <td>{{ $task['apell'] }}</td>
                    <td>{{ $task['descripcion'] }}</td>
                    <td>{{ $task['estado'] }}</td>
                    <td>{{ $task['fecha_creacion'] }}</td>
                    <td><a href="{!!miUrl("detallesTarea/{$task['task_id']}")!!}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>
                    </a></td>
                    <td><a href="{!!miUrl("modificarTarea/{$task['task_id']}")!!}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>    
                    </a></td>
                    @if ($_SESSION['status'] == 'A')
                        <td><a href="{!!miUrl("confirmarEliminarTarea/{$task['task_id']}")!!}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>    
                        </a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        <a href="?page=1" style="{{ $page == 1 ? 'pointer-events: none; color: gray;' : '' }}">Primera</a> | 
        <a href="?page={{ $page - 1 }}" style="{{ $page == 1 ? 'pointer-events: none; color: gray;' : '' }}">Anterior</a> | 

        <span>Página {{ $page }} de {{ $totalPages }}</span> | 

        <a href="?page={{ $page + 1 }}" style="{{ $page == $totalPages ? 'pointer-events: none; color: gray;' : '' }}">Siguiente</a> | 
        <a href="?page={{ $totalPages }}" style="{{ $page == $totalPages ? 'pointer-events: none; color: gray;' : '' }}">Última</a>
    </div>
@endsection
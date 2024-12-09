@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Listado de tareas</h3>

    {{-- FILTRADO POR CAMPOS --}}
    <form method="POST" id="filterForm">
        @csrf
        Estado: 
        <select name="estado-query" id="estado-query">
            <option value="" {{ $filters['estado'] == '' ? 'selected' : '' }}>Todo</option>
            <option value="B" {{ $filters['estado'] == 'B' ? 'selected' : '' }}>Esperando a Ser Aprobada (B)</option>
            <option value="P" {{ $filters['estado'] == 'P' ? 'selected' : '' }}>Pendiente (P)</option>
            <option value="R" {{ $filters['estado'] == 'R' ? 'selected' : '' }}>Realizada (R)</option>
            <option value="C" {{ $filters['estado'] == 'C' ? 'selected' : '' }}>Cancelada (C)</option>
        </select><br>
        Identificador: <input type="text" name="id-query" id="id-query" style="width: 45px" value="{{ $filters['id'] }}">
        <select name="id-query-criterio" id="id-query-criterio">
            <option value="=" {{ $filters['idCriterio'] == '=' ? 'selected' : '' }}>=</option>
            <option value=">" {{ $filters['idCriterio'] == '>' ? 'selected' : '' }}>></option>
            <option value="<" {{ $filters['idCriterio'] == '<' ? 'selected' : '' }}><</option>
        </select>
         --- Fecha de Creación: <input type="date" name="fecha-creacion-query" id="fecha-creacion-query" value="{{ $filters['fechaCreacion'] }}">
        <select name="fecha-creacion-query-criterio" id="fecha-creacion-query-criterio">
            <option value="=" {{ $filters['fechaCreacionCriterio'] == '=' ? 'selected' : '' }}>=</option>
            <option value=">" {{ $filters['fechaCreacionCriterio'] == '>' ? 'selected' : '' }}>></option>
            <option value="<" {{ $filters['fechaCreacionCriterio'] == '<' ? 'selected' : '' }}><</option>
        </select>
         --- Fecha de Realización: <input type="date" name="fecha-realizacion-query" id="fecha-realizacion-query" value="{{ $filters['fechaRealizacion'] }}">
        <select name="fecha-realizacion-query-criterio" id="fecha-realizacion-query-criterio">
            <option value="=" {{ $filters['fechaRealizacionCriterio'] == '=' ? 'selected' : '' }}>=</option>
            <option value=">" {{ $filters['fechaRealizacionCriterio'] == '>' ? 'selected' : '' }}>></option>
            <option value="<" {{ $filters['fechaRealizacionCriterio'] == '<' ? 'selected' : '' }}><</option>
        </select>
         --- <button type="submit">Buscar</button>
    </form>

    <br>
    <table border="1" style="border-collapse: collapse">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Fecha de realización</th>
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
                    <td>{{ $task['fecha_realizacion'] ?? 'N/A' }}</td>
                    <td><a href="{!!miUrl("detallesTarea/{$task['task_id']}")!!}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 3.5a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
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
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination" style="{{$totalPages == 0 ? "display: none" : ''}}">
        <form method="POST" id="paginationForm">
            <input type="hidden" name="page" value="{{ $page }}">
            <input type="hidden" name="estado-query" value="{{ $filters['estado'] }}">
            <input type="hidden" name="id-query" value="{{ $filters['id'] }}">
            <input type="hidden" name="id-query-criterio" value="{{ $filters['idCriterio'] }}">
            <input type="hidden" name="fecha-creacion-query" value="{{ $filters['fechaCreacion'] }}">
            <input type="hidden" name="fecha-creacion-query-criterio" value="{{ $filters['fechaCreacionCriterio'] }}">
            <input type="hidden" name="fecha-realizacion-query" value="{{ $filters['fechaRealizacion'] }}">
            <input type="hidden" name="fecha-realizacion-query-criterio" value="{{ $filters['fechaRealizacionCriterio'] }}">
    
            <button type="submit" name="page" value="1" style="{{ $page == 1 ? 'pointer-events: none; color: gray;' : '' }}">Primera</button> | 
            <button type="submit" name="page" value="{{ $page - 1 }}" style="{{ $page == 1 ? 'pointer-events: none; color: gray;' : '' }}">Anterior</button> | 
            <span>Página {{ $page }} de {{ $totalPages }}</span> | 
            <button type="submit" name="page" value="{{ $page + 1 }}" style="{{ $page == $totalPages ? 'pointer-events: none; color: gray;' : '' }}">Siguiente</button> | 
            <button type="submit" name="page" value="{{ $totalPages }}" style="{{ $page == $totalPages ? 'pointer-events: none; color: gray;' : '' }}">Última</button>
        </form>
    </div>
@endsection
@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Detalles de la Tarea</h3>
    <table border="1" style="border-collapse: collapse">
        <tr>
            <td>Id tarea</td>
            <td>{{$task['task_id']}}</td>
        </tr>    
        <tr>
            <td>NIF Cliente</td>
            <td>{{$task['num_fiscal_cliente']}}</td>
        </tr>    
        <tr>
            <td>Nombre</td>
            <td>{{$task['nombre']}}</td>
        </tr>    
        <tr>
            <td>Apellidos</td>
            <td>{{$task['apell']}}</td>
        </tr>    
        <tr>
            <td>Teléfono</td>
            <td>{{$task['tlf']}}</td>
        </tr>    
        <tr>
            <td>Descripción</td>
            <td>{{$task['descripcion']}}</td>
        </tr>    
        <tr>
            <td>Email</td>
            <td>{{$task['email']}}</td>
        </tr>    
        <tr>
            <td>Dirección</td>
            <td>{{$task['direccion']}}</td>
        </tr>    
        <tr>
            <td>Población</td>
            <td>{{$task['poblacion']}}</td>
        </tr>    
        <tr>
            <td>Código Postal</td>
            <td>{{$task['codigo_post']}}</td>
        </tr>    
        <tr>
            <td>Provincia</td>
            <td>{{$task['provincia']}}</td>
        </tr>    
        <tr>
            <td>Estado</td>
            <td>{{$task['estado']}}</td>
        </tr>    
        <tr>
            <td>Fecha Creación</td>
            <td>{{$task['fecha_creacion']}}</td>
        </tr>    
        <tr>
            <td>Operario</td>
            <td>{{$task['operario']}}</td>
        </tr>    
        <tr>
            <td>Fecha Realización</td>
            <td>{{$task['fecha_realizacion']}}</td>
        </tr>    
        <tr>
            <td>Anotaciones Anteriores</td>
            <td>{{$task['anotaciones_anteriores']}}</td>
        </tr>    
        <tr>
            <td>Anotaciones Posteriores</td>
            <td>{{$task['anotaciones_posteriores']}}</td>
        </tr>    
        <tr>
            <td>Fichero Resumen</td>
            <td>{{$task['fich_resu']}}</td>
        </tr>    
        <tr>
            <td>Foto</td>
            <td>
                {{$task['foto']}}<br>
                @if($task['foto'])
                    <img src="{!!'../../uploads/'.$task['foto']!!}" alt="Foto" width="400px">
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <a href="{!!miUrl("modificarTarea/{$task['task_id']}")!!}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>    
                </a>
            </td>
            <td>
                @if($_SESSION['status'] == 'A')
                    <a href="{!!miUrl("confirmarEliminarTarea/{$task['task_id']}")!!}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>    
                    </a>
                @endif
            </td>
        </tr>
    </table>
@endsection
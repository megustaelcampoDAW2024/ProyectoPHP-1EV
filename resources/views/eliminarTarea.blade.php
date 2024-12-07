@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>¿Desea Eliminar la Tarea?</h3>
    <table border="1" style="border-collapse: collapse">
        <tr>
            <th style="background-color: red;"><a href="{!!miUrl("eliminarTarea/{$id}")!!}">Eliminar Tarea</a></th>
            <th style="background-color: green;"><a href="{!!miUrl("detallesTarea/{$id}")!!}">Cancelar</a></th>
        </tr>
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
            <td>Operario</td>
            <td>{{$task['operario']}}</td>
        </tr>
        <tr>
            <td>Fecha Creación</td>
            <td>{{$task['fecha_creacion']}}</td>
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
            <td>
                @if($task['fich_resu'])
                    <p>Nombre Archivo:<br> {{$task['fich_resu']}}</p>
                    <a href="{!!'../../storage/app/public/'.$task['fich_resu']!!}" target="_blank">CONSULTAR</a> | 
                    <a href="{!!'../../storage/app/public/'.$task['fich_resu']!!}" download>DESCARGAR</a><br>
                    <embed src="{!!'../../storage/app/public/'.$task['fich_resu']!!}" width="400px" height="600px">
                @endif
            </td>
        </tr>    
        <tr>
            <td>Foto</td>
            <td>
                @if($task['foto'])
                    <p>Nombre Archivo:<br> {{$task['foto']}}</p>
                    <a href="{!!'../../storage/app/public/'.$task['foto']!!}" target="_blank">CONSULTAR</a> | 
                    <a href="{!!'../../storage/app/public/'.$task['foto']!!}" download>DESCARGAR</a><br>
                    <img src="{!!'../../storage/app/public/'.$task['foto']!!}" alt="Foto" width="400px">
                @endif
            </td>
        </tr>
    </table>
@endsection
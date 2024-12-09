@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <form method="post" enctype="multipart/form-data" class="container mt-4">
        <fieldset class="border p-4">
            <legend class="w-auto"><b>Formulario {{ isset($task) ? 'Modificación' : 'Creación' }} de Tarea</b></legend>

            @if($_SESSION['status'] == 'A')
                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('num-fiscal-cliente', $errores) : '' }} for="num-fiscal-cliente">
                        @php $utiles->contenidoLabel('num-fiscal-cliente', 'DNI/CIF Cliente *', $errores) @endphp</label>
                    <input type="text" class="form-control" name="num-fiscal-cliente" id="num-fiscal-cliente" value="{{ ($_POST) ? $utiles->valorPost('num-fiscal-cliente') : ($task['num_fiscal_cliente'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('nombre', $errores) : '' }} for="nombre">
                        @php $utiles->contenidoLabel('nombre', 'Nombre Cliente *', $errores) @endphp</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{ ($_POST) ? $utiles->valorPost('nombre') : ($task['nombre'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('apell', $errores) : '' }} for="apell">
                        @php $utiles->contenidoLabel('apell', 'Apellidos Cliente *', $errores) @endphp</label>
                    <input type="text" class="form-control" name="apell" id="apell" value="{{ ($_POST) ? $utiles->valorPost('apell') : ($task['apell'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('tlf', $errores) : '' }} for="tlf">
                        @php $utiles->contenidoLabel('tlf', 'Teléfono Cliente *', $errores) @endphp</label>
                    <input type="text" class="form-control" name="tlf" id="tlf" value="{{ ($_POST) ? $utiles->valorPost('tlf') : ($task['tlf'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('descripcion', $errores) : '' }} for="descripcion">
                        @php $utiles->contenidoLabel('descripcion', 'Descripción de la Tarea *', $errores) @endphp</label>
                    <textarea class="form-control" name="descripcion" id="descripcion">{{ ($_POST) ? $utiles->valorPost('descripcion') : ($task['descripcion'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('email', $errores) : '' }} for="email">
                        @php $utiles->contenidoLabel('email', 'E-mail Cliente *', $errores) @endphp</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ ($_POST) ? $utiles->valorPost('email') : ($task['email'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección de Realización</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{ ($_POST) ? $utiles->valorPost('direccion') : ($task['direccion'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="poblacion">Población de Realización</label>
                    <input type="text" class="form-control" name="poblacion" id="poblacion" value="{{ ($_POST) ? $utiles->valorPost('poblacion') : ($task['poblacion'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('codigo-post', $errores) : '' }} for="codigo-post">
                        @php $utiles->contenidoLabel('codigo-post', 'Código Postal de Realización', $errores) @endphp</label>
                    <input type="text" class="form-control" name="codigo-post" id="codigo-post" value="{{ ($_POST) ? $utiles->valorPost('codigo-post') : ($task['codigo_post'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="provincia">Provincia de Realización</label>
                    <select class="form-control" name="provincia" id="provincia">
                        <option value="0" hidden>Provincia</option>
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia['cod'] }}" {{ ($_POST) ? ($utiles->valorPost('provincia') == $provincia['cod'] ? 'selected' : '') : 
                            (isset($task) && $task['provincia'] == $provincia['cod'] ? 'selected' : '') }}>{{ $provincia['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="operario">Operario que Realiza la Tarea</label>
                    <select class="form-control" name="operario" id="operario">
                        <option value="0" {{ ($_POST) ? ($utiles->valorPost('operario') == '0' ? 'selected' : '') : (isset($task) && $task['operario'] == '0' ? 'selected' : '') }} hidden>Operario</option>
                        <option value="1" {{ ($_POST) ? ($utiles->valorPost('operario') == '1' ? 'selected' : '') : (isset($task) && $task['operario'] == '1' ? 'selected' : '') }}>Jose Miguel Ramirez</option>
                        <option value="2" {{ ($_POST) ? ($utiles->valorPost('operario') == '2' ? 'selected' : '') : (isset($task) && $task['operario'] == '2' ? 'selected' : '') }}>Manuel Fernandez</option>
                        <option value="3" {{ ($_POST) ? ($utiles->valorPost('operario') == '3' ? 'selected' : '') : (isset($task) && $task['operario'] == '3' ? 'selected' : '') }}>Ana Nuñez</option>
                        <option value="4" {{ ($_POST) ? ($utiles->valorPost('operario') == '4' ? 'selected' : '') : (isset($task) && $task['operario'] == '4' ? 'selected' : '') }}>Juan Rodriguez</option>
                    </select>
                </div>
            @endif

            <div class="form-group">
                <label for="fecha-creacion">Fecha de Creación de la Tarea</label>
                <input type="text" class="form-control" name="fecha-creacion" id="fecha-creacion" value="{{($_POST) ? $utiles->valorPost('fecha-creacion') : (isset($task) ? $task['fecha_creacion'] : date('d-m-Y'))}}" readonly>
            </div>
                
            @if($_SESSION['status'] == 'O')
                <div class="form-group">
                    <label {{ ($_POST) ? $utiles->colorLabel('fecha-realizacion', $errores) : '' }} for="fecha-realizacion">
                        @php $utiles->contenidoLabel('fecha-realizacion', 'Fecha de Realizacion de la Tarea', $errores) @endphp</label>
                    <input type="text" class="form-control" name="fecha-realizacion" id="fecha-realizacion" value="{{ ($_POST) ? $utiles->valorPost('fecha-realizacion') : ($task['fecha_realizacion'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="estado">Estado de la Tarea</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="estado" id="estado" value="B" {{ ($_POST) ? ($utiles->valorPost('estado') == 'B' ? 'checked' : '') : (isset($task) && $task['estado'] == 'B' ? 'checked' : '') }}>Esperando a Ser Aprobada
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="estado" id="estado" value="P" {{ ($_POST) ? ($utiles->valorPost('estado') == 'P' ? 'checked' : '') : (isset($task) && $task['estado'] == 'P' ? 'checked' : '') }}>Pendiente
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="estado" id="estado" value="R" 
                        {{ ($_POST && ($utiles->valorPost('estado') == 'R' || $utiles->valorPost('estado') == '')) || (!$_POST && (!isset($task) || $task['estado'] == 'R' || $task['estado'] == '')) ? 'checked' : '' }}>Realizada
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="estado" id="estado" value="C" {{ ($_POST) ? ($utiles->valorPost('estado') == 'C' ? 'checked' : '') : (isset($task) && $task['estado'] == 'C' ? 'checked' : '') }}>Cancelada
                    </div>
                </div>

                <div class="form-group">
                    <label for="anotaciones-anteriores">Anotaciones Anteriores a la Tarea</label>
                    <textarea class="form-control" name="anotaciones-anteriores" id="anotaciones-anteriores">{{ ($_POST) ? $utiles->valorPost('anotaciones-anteriores') : ($task['anotaciones_anteriores'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="anotaciones-posteriores">Anotaciones Posteriores a la Tarea</label>
                    <textarea class="form-control" name="anotaciones-posteriores" id="anotaciones-posteriores">{{ ($_POST) ? $utiles->valorPost('anotaciones-posteriores') : ($task['anotaciones_posteriores'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="fich-resu">Fichero Resumen de las Tareas Realizadas</label>
                    @if(isset($task['fich_resu']))
                        <p>Archivo actual: {{ $task['fich_resu'] }} --- <a href="{{miUrl("eliminarFichResu/{$id}")}}">ELIMINAR</a></p>
                    @endif
                    <input type="file" class="form-control-file" name="fich-resu" id="fich-resu" accept=".pdf">
                </div>

                <div class="form-group">
                    <label for="foto">Foto de las Tareas Realizadas</label>
                    @if(isset($task['foto']))
                        <p>Archivo actual: {{ $task['foto'] }} --- <a href="{{miUrl("eliminarFoto/{$id}")}}">ELIMINAR</a></p>
                    @endif
                    <input type="file" class="form-control-file" name="foto" id="foto" accept=".jpg, .jpeg, .png">
                </div>
            @endif
            <button type="submit" class="btn btn-primary">{{ isset($task) ? 'Actualizar' : 'Enviar' }}</button>
        </fieldset>
    </form>
@endsection
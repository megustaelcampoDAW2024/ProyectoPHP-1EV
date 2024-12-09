@extends('Layout.plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Crear Usuario</h3>
    <form method="post">
        <fieldset>
            <legend>Información del Usuario</legend>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required><br>
            <label for="status">Status:</label>
            <select name="status">
                <option value="A">Administrador</option>
                <option value="O">Operario</option>
            </select><br>
            <button type="submit">Crear</button>
        </fieldset>
    </form>
@endsection
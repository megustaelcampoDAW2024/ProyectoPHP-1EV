<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <header>
            <p style="text-align: right;">Usuario: {{$_SESSION['usuario']}} | @if($_SESSION['status'] == 'A') Administrador @else Operario @endif | <a href="{{miUrl('logOut')}}">Log Out</a></p>
            <h1>@yield('titulo')</h1>
        </header>
        <nav>
            <ul>
                <li><a href="<?=miUrl('inicio')?>">Inicio</a></li>
                <li><a href="<?=miUrl('listarTareas')?>">Listar Tareas</a></li>
                @if ($_SESSION['status'] == 'A')
                    <li><a href="<?=miUrl('crearTarea')?>">Crear Tarea</a></li>
                @endif
            </ul>
        </nav>
        <section>
            @yield('seccion')
        </section>
        <footer>
            <p>Derechos reservados por megustaelcampo. Registrado &copy; {{ date('Y') }}</p>
        </footer>
    </body>
</html>
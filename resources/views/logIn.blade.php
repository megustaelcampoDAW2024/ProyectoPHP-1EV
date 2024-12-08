<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form method="POST">
            @if(!$logError)
                <h3>Log In</h3>
            @else
                <h3 style="color: red">Usuario o Contraseña Incorrectos</h3>
            @endif
            <label for="user">Usuario</label><br>
            <input type="text" name="user" id="user" value="{{ $utiles->valorPost('user') !== '' ? $utiles->valorPost('user') : (isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : '') }}"><br><br>
            
            <label for="pass">Password</label><br>
            <input type="password" name="pass" id="pass" value="{{ $utiles->valorPost('pass') !== '' ? $utiles->valorPost('pass') : (isset($_COOKIE['password']) ? $_COOKIE['password'] : '') }}"><br><br>

            <label for="remember">Recordar Usuario</label>
            <input type="checkbox" name="remember" id="remember" {{ $utiles->valorPost('remember') ? 'checked' : '' }}><br><br>
            
            <button type="submit">Log In</button>
        </form>
    </body>
</html>
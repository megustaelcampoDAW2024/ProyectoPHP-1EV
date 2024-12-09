<?php

namespace App\Http\Controllers;

use App\Models\dbModel;
use App\Models\GestorErrores;
use App\Models\Utiles;
use App\Models\Task;
use App\Models\SessionUsuario;

class Tareas extends Controller
{

    private $sessionUsuario;

    public function __construct()
    {
        $this->sessionUsuario = new SessionUsuario();
    }

    public function inicio()
    {
        if($this->sessionUsuario->isLogged()){
            return view('inicio');
        }else{
            myRedirect("logIn");
        }
    }

    public function listarTareas()
    {
        if ($this->sessionUsuario->isLogged()) {
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
            $perPage = 10;
            $offset = ($page - 1) * $perPage;
    
            $filters = [
                'estado' => $_POST['estado-query'] ?? null,
                'id' => $_POST['id-query'] ?? null,
                'idCriterio' => $_POST['id-query-criterio'] ?? '=',
                'fechaCreacion' => $_POST['fecha-creacion-query'] ?? null,
                'fechaCreacionCriterio' => $_POST['fecha-creacion-query-criterio'] ?? '=',
                'fechaRealizacion' => $_POST['fecha-realizacion-query'] ?? null,
                'fechaRealizacionCriterio' => $_POST['fecha-realizacion-query-criterio'] ?? '='
            ];
    
            $totalTasks = dbModel::countFilteredTasks($filters);
            $tasks = dbModel::getFilteredTasks($perPage, $offset, $filters);
    
            $totalPages = ceil($totalTasks / $perPage);
    
            return view('listarTareas', compact('tasks', 'page', 'totalPages', 'filters'));
        } else {
            myRedirect("logIn");
        }
    }

    public function detallesTarea($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            $operario = dbModel::getUsuarioNameById($task['operario_id']);
            return view('detallesTarea', compact('task', 'operario'));
        }else{
            myRedirect("logIn");
        }
    }

    public function crearTarea()
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $errores = new GestorErrores();
            $utiles = new Utiles();
            $provincias = dbModel::getProvincias();
            $operarios = dbModel::getOperarios();
            if($_POST){
                $utiles -> filtroForm($errores);
                if(!$errores -> HayErrores()){
                    $task = new Task();
                    dbModel::insertTask($task);
                    myRedirect("listarTareas");
                }else{
                    return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios'));
                }
            }else{
                return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios'));
            }
        }else{
            myRedirect("logIn");
        }
    }

    public function modificarTarea($id)
    {
        if($this->sessionUsuario->isLogged()){
            $errores = new GestorErrores();
            $utiles = new Utiles();
            $provincias = dbModel::getProvincias();
            $operarios = dbModel::getOperarios();
            $task = dbModel::getTaskById($id);

            if ($_POST) {
                $utiles->filtroForm($errores);
                if (!$errores->HayErrores()) {
                    $updatedTask = new Task();

                    if(isset($_FILES['fich-resu']) || isset($_FILES['foto'])){//Si se sube un archivo o una foto
                        if (isset($_FILES['fich-resu']) && $_FILES['fich-resu']['error'] == UPLOAD_ERR_OK) {//Guardar el archivo si existe
                            $fichResu = $_FILES['fich-resu'];
                            $fichResuName = time() . '_' . basename($fichResu['name']);
                            $dir = __DIR__ . '/../../../storage/app/public/';
                            move_uploaded_file($fichResu['tmp_name'], $dir . $fichResuName);
                            $updatedTask->fich_resu = $fichResuName;
                        }
                        if($task['fich_resu'] != null && $_FILES['fich-resu']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                            $updatedTask->fich_resu = $task['fich_resu'];
                        }elseif($task['fich_resu'] != null && $_FILES['fich-resu']['name'] != ''){//Si se sube un archivo, borrar el anterior
                            unlink(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu']);
                        }
    
                        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {//Guardar la foto si existe
                            $foto = $_FILES['foto'];
                            $fotoName = time() . '_' . basename($foto['name']);
                            $dir = __DIR__ . '/../../../storage/app/public/';
                            move_uploaded_file($foto['tmp_name'], $dir . $fotoName);
                            $updatedTask->foto = $fotoName;
                        }
                        if($task['foto'] != null && $_FILES['foto']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                            $updatedTask->foto = $task['foto'];
                        }elseif($task['foto'] != null && $_FILES['foto']['name'] != ''){//Si se sube un archivo, borrar el anterior
                            unlink(__DIR__ . '/../../../storage/app/public/' . $task['foto']);
                        }
                    }
                    
                    if($_SESSION['status'] == 'A'){
                        dbModel::updateTaskAdmin($updatedTask, $id);
                    }elseif($_SESSION['status'] == 'O'){
                        dbModel::updateTaskOperario($updatedTask, $id);
                    }
                    myRedirect("detallesTarea/$id");
                } else {
                    return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios',  'task', 'id'));
                }
            } else {
                return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios', 'task', 'id'));
            }
        }else{
            myRedirect("logIn");
        }
    }

    public function confirmarEliminarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $task = dbModel::getTaskById($id);
            return view('eliminarTarea', compact('task', 'id'));
        }else{
            myRedirect("listarTareas");
        }
    }

    public function eliminarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $task = dbModel::getTaskById($id);
            if ($task['foto']) {//Borrar la foto si existe
                unlink(__DIR__ . '/../../../storage/app/public/' . $task['foto']);
            }
            if ($task['fich_resu']) {//Borrar el archivo si existe
                unlink(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu']);
            }
            dbModel::deleteTask($id);
            myRedirect("listarTareas");
        } else {
            myRedirect("logIn");
        }
    }

    public function logIn()
    {
        if($this->sessionUsuario->isLogged()){
            myRedirect('inicio');
        }else{
            $logError = false;
            $utiles = new Utiles();
            if($_POST){
                if(dbModel::checkUser($_POST['user'], $_POST['pass'])){
                    $user = dbModel::getUser($_POST['user'], $_POST['pass']);
                    $this->sessionUsuario->logIn($user['usuario'], $user['password'], $user['status']);
                    if(isset($_POST['remember']) && $_POST['remember'] == 'on'){ //solo si el checkbox está marcado
                        setcookie('usuario', $_POST['user'], time() + (86400 * 3), "/"); // 86400 = 1 day
                        setcookie('password', $_POST['pass'], time() + (86400 * 3), "/");
                    }
                    myRedirect("inicio");
                }else{
                    $logError = true;
                    return view('logIn', compact('utiles','logError'));
                }
            }else{
                return view('logIn', compact('utiles', 'logError'));
            }
        }
    }

    public function eliminarFoto($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'O'){
            $task = dbModel::getTaskById($id);
            unlink(__DIR__ . '/../../../storage/app/public/' . $task['foto']);
            dbModel::deleteFicheros("foto", $id);
            myRedirect("modificarTarea/$id");
        }else{
            myRedirect("logIn");
        }
    }

    public function eliminarFichResu($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'O'){
            $task = dbModel::getTaskById($id);
            unlink(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu']);
            dbModel::deleteFicheros("fich_resu", $id);
            myRedirect("modificarTarea/$id");
        }else{
            myRedirect("logIn");
        }
    }

    public function logOut()
    {
        $this->sessionUsuario->destroy();
        myRedirect("logIn");
    }

    public function administrarUsuarios()
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            $usuarios = dbModel::getUsuarios();
            return view('administrarUsuarios', compact('usuarios'));
        } else {
            myRedirect("logIn");
        }
    }

    public function crearUsuario()
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            if ($_POST) {
                dbModel::crearUsuario($_POST['usuario'], $_POST['password'], $_POST['status']);
                myRedirect("administrarUsuarios");
            } else {
                return view('crearUsuario');
            }
        } else {
            myRedirect("logIn");
        }
    }

    public function editarUsuario($id)
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            if ($_POST) {
                dbModel::editarUsuario($id, $_POST['usuario'], $_POST['password'], $_POST['status']);
                myRedirect("administrarUsuarios");
            } else {
                $usuario = dbModel::getUsuarioById($id);
                return view('editarUsuario', compact('usuario'));
            }
        } else {
            myRedirect("logIn");
        }
    }

    public function eliminarUsuario($id)
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            dbModel::eliminarUsuario($id);
            myRedirect("administrarUsuarios");
        } else {
            myRedirect("logIn");
        }
    }

}
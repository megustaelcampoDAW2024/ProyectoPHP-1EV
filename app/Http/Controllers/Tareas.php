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
        if($this->sessionUsuario->isLogged()){
            $tasks = dbModel::getTasksOrderedByDate();
            return view('listarTareas', compact('tasks'));
        }else{
            myRedirect("logIn");
        }
    }

    public function listarTareasPorCompletar()
    {
        if($this->sessionUsuario->isLogged()){
            $tasks = dbModel::getUncompletedTasks();
            return view('listarTareas', compact('tasks'));
        }else{
            myRedirect("logIn");
        }
    }

    public function detallesTarea($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            return view('detallesTarea', compact('task'));
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
            if($_POST){
                $utiles -> filtroForm($errores);
                if(!$errores -> HayErrores()){
                    $task = new Task();
                    dbModel::insertTask($task);
                    myRedirect("listarTareas");
                }else{
                    return view('crearTarea', compact('errores', 'utiles', 'provincias'));
                }
            }else{
                return view('crearTarea', compact('errores', 'utiles', 'provincias'));
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
            $task = dbModel::getTaskById($id);

            if ($_POST) {
                $utiles->filtroForm($errores);
                if (!$errores->HayErrores()) {
                    $updatedTask = new Task();

                    if (isset($_FILES['fich-resu']) && $_FILES['fich-resu']['error'] == UPLOAD_ERR_OK) {//Guardar el archivo si existe
                        $fichResu = $_FILES['fich-resu'];
                        $fichResuName = time() . '_' . basename($fichResu['name']);
                        $dir = __DIR__ . '/../../../uploads/';
                        move_uploaded_file($fichResu['tmp_name'], $dir . $fichResuName);
                        $updatedTask->fich_resu = $fichResuName;
                    }
                    if($task['fich_resu'] != null && $_FILES['fich-resu']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                        $updatedTask->fich_resu = $task['fich_resu'];
                    }elseif($task['fich_resu'] != null && $_FILES['fich-resu']['name'] != ''){//Si se sube un archivo, borrar el anterior
                        unlink(__DIR__ . '/../../../uploads/' . $task['fich_resu']);
                    }

                    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {//Guardar la foto si existe
                        $foto = $_FILES['foto'];
                        $fotoName = time() . '_' . basename($foto['name']);
                        $dir = __DIR__ . '/../../../uploads/';
                        move_uploaded_file($foto['tmp_name'], $dir . $fotoName);
                        $updatedTask->foto = $fotoName;
                    }
                    if($task['foto'] != null && $_FILES['foto']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                        $updatedTask->foto = $task['foto'];
                    }elseif($task['foto'] != null && $_FILES['foto']['name'] != ''){//Si se sube un archivo, borrar el anterior
                        unlink(__DIR__ . '/../../../uploads/' . $task['foto']);
                    }
                    
                    if($_SESSION['status'] == 'A'){
                        dbModel::updateTaskAdmin($updatedTask, $id);
                    }elseif($_SESSION['status'] == 'O'){
                        dbModel::updateTaskOperario($updatedTask, $id);
                    }
                    myRedirect("listarTareas");
                } else {
                    return view('modificarTarea', compact('errores', 'utiles', 'provincias', 'task', 'id'));
                }
            } else {
                return view('modificarTarea', compact('errores', 'utiles', 'provincias', 'task', 'id'));
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
            dbModel::deleteTask($id);
            myRedirect("listarTareas");
        }else{
            myRedirect("listarTareas");
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
                echo "hay post";
                if(dbModel::checkUser($_POST['user'], $_POST['pass'])){
                    echo ", existe";
                    $user = dbModel::getUser($_POST['user'], $_POST['pass']);
                    $_SESSION['usuario'] = $user['usuario'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['status'] = $user['status'];
                    myRedirect("inicio");
                }else{
                    echo ", no existe";
                    $logError = true;
                    return view('logIn', compact('utiles','logError'));
                }
            }else{
                echo "no hay post";
                return view('logIn', compact('utiles', 'logError'));
            }
        }
    }

    public function eliminarFoto($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            unlink(__DIR__ . '/../../../uploads/' . $task['foto']);
            dbModel::deleteFicheros("foto", $id);
            myRedirect("modificarTarea/$id");
        }else{
            myRedirect("logIn");
        }
    }

    public function eliminarFichResu($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            unlink(__DIR__ . '/../../../uploads/' . $task['fich_resu']);
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

}
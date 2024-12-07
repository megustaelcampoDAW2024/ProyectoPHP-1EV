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
                    dbModel::updateTask($updatedTask, $id);
                    myRedirect("listarTareas");
                } else {
                    return view('modificarTarea', compact('errores', 'utiles', 'provincias', 'task'));
                }
            } else {
                return view('modificarTarea', compact('errores', 'utiles', 'provincias', 'task'));
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
            myRedirect("logIn");
        }
    }

    public function eliminarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            dbModel::deleteTask($id);
            myRedirect("listarTareas");
        }else{
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

}
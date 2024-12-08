<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SingletonDB;

class dbModel extends Model
{
    public static function getTasksOrderedByDate()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT task_id, nombre, apell, descripcion, estado, fecha_creacion 
        FROM task 
        ORDER BY fecha_creacion DESC";
        $result = $db->conn->query($sql);
        $tasks = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $row['fecha_creacion'] = date('d-m-Y', strtotime($row['fecha_creacion']));
            $tasks[] = $row;
        }
        return $tasks;
    }

    public static function getUncompletedTasks()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT task_id, nombre, apell, descripcion, estado, fecha_creacion 
        FROM task 
        WHERE estado != 'R'
        ORDER BY fecha_creacion DESC";
        $result = $db->conn->query($sql);
        $tasks = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $row['fecha_creacion'] = date('d-m-Y', strtotime($row['fecha_creacion']));
            $tasks[] = $row;
        }
        return $tasks;
    }

    public static function getTaskById($id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT task_id, num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, 
        codigo_post, provincia, estado, fecha_creacion, operario, fecha_realizacion, anotaciones_anteriores, 
        anotaciones_posteriores, fich_resu, foto
        FROM task 
        WHERE task_id = $id";
        $result = $db->conn->query($sql);
        $task = $result->fetch(\PDO::FETCH_ASSOC);
        if ($task) {
            $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
        }
        return $task;
    }

    public static function getProvincias()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT cod, nombre, comunidad_id
        FROM tbl_provincias
        ORDER BY comunidad_id";
        $result = $db->conn->query($sql);
        return $result;
    }

    public static function insertTask($task)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, 
        codigo_post, provincia, estado, fecha_creacion, operario, fecha_realizacion, anotaciones_anteriores, 
        anotaciones_posteriores, fich_resu, foto)
        VALUES (" . 
            (($task->num_fiscal_cliente !== null && $task->num_fiscal_cliente != '') ? "'$task->num_fiscal_cliente'" : "11111111") . "," . 
            (($task->nombre !== null && $task->nombre != '') ? "'$task->nombre'" : "NULL") . ", " . 
            (($task->apell !== null && $task->apell != '') ? "'$task->apell'" : "NULL") . ", " . 
            (($task->tlf !== null && $task->tlf != '') ? "'$task->tlf'" : "NULL") . ", " . 
            (($task->descripcion !== null && $task->descripcion != '') ? "'$task->descripcion'" : "NULL") . ", " . 
            (($task->email !== null && $task->email != '') ? "'$task->email'" : "NULL") . ", " . 
            (($task->direccion !== null && $task->direccion != '') ? "'$task->direccion'" : "NULL") . ", " . 
            (($task->poblacion !== null && $task->poblacion != '') ? "'$task->poblacion'" : "NULL") . ", " . 
            (($task->codigo_post !== null && $task->codigo_post != '') ? "'$task->codigo_post'" : "NULL") . ", " . 
            (($task->provincia !== null && $task->provincia != 0) ? "'$task->provincia'" : "NULL") . ", " . 
            "NULL, " . 
            (($task->fecha_creacion !== null && $task->fecha_creacion != '') ? "'$task->fecha_creacion'" : "'1111-11-11'") . ", " . 
            (($task->operario !== null && $task->operario != 0) ? "'$task->operario'" : "NULL") . ", " . 
            "NULL, NULL, NULL, NULL, NULL)";
        $result = $db->conn->query($sql);
        return $result;
    }

    public static function updateTaskAdmin($updatedTask, $id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "UPDATE task 
        SET num_fiscal_cliente = " . 
            (($updatedTask->num_fiscal_cliente !== null && $updatedTask->num_fiscal_cliente != '') ? "'$updatedTask->num_fiscal_cliente'" : "11111111") . ", " . 
            "nombre = " . 
            (($updatedTask->nombre !== null && $updatedTask->nombre != '') ? "'$updatedTask->nombre'" : "NULL") . ", " . 
            "apell = " . 
            (($updatedTask->apell !== null && $updatedTask->apell != '') ? "'$updatedTask->apell'" : "NULL") . ", " . 
            "tlf = " . 
            (($updatedTask->tlf !== null && $updatedTask->tlf != '') ? "'$updatedTask->tlf'" : "NULL") . ", " . 
            "descripcion = " . 
            (($updatedTask->descripcion !== null && $updatedTask->descripcion != '') ? "'$updatedTask->descripcion'" : "NULL") . ", " . 
            "email = " . 
            (($updatedTask->email !== null && $updatedTask->email != '') ? "'$updatedTask->email'" : "NULL") . ", " . 
            "direccion = " . 
            (($updatedTask->direccion !== null && $updatedTask->direccion != '') ? "'$updatedTask->direccion'" : "NULL") . ", " . 
            "poblacion = " . 
            (($updatedTask->poblacion !== null && $updatedTask->poblacion != '') ? "'$updatedTask->poblacion'" : "NULL") . ", " . 
            "codigo_post = " . 
            (($updatedTask->codigo_post !== null && $updatedTask->codigo_post != '') ? "'$updatedTask->codigo_post'" : "NULL") . ", " . 
            "provincia = " . 
            (($updatedTask->provincia !== null && $updatedTask->provincia != 0) ? "'$updatedTask->provincia'" : "NULL") . ", " . 
            "fecha_creacion = " . 
            (($updatedTask->fecha_creacion !== null && $updatedTask->fecha_creacion != '') ? "'$updatedTask->fecha_creacion'" : "'1111-11-11'") . ", " . 
            "operario = " . 
            (($updatedTask->operario !== null && $updatedTask->operario != 0) ? "'$updatedTask->operario'" : "NULL") . "
            WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

    public static function updateTaskOperario($updatedTask, $id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "UPDATE task 
        SET estado = " . 
            (($updatedTask->estado !== null && $updatedTask->estado != '') ? "'$updatedTask->estado'" : "NULL") . ", " .
            "fecha_realizacion = " . 
            (($updatedTask->fecha_realizacion !== null && $updatedTask->fecha_realizacion != '') ? "'$updatedTask->fecha_realizacion'" : "NULL") . ", " .
            "anotaciones_anteriores = " . 
            (($updatedTask->anotaciones_anteriores !== null && $updatedTask->anotaciones_anteriores != '') ? "'$updatedTask->anotaciones_anteriores'" : "NULL") . ", " .
            "anotaciones_posteriores = " . 
            (($updatedTask->anotaciones_posteriores !== null && $updatedTask->anotaciones_posteriores != '') ? "'$updatedTask->anotaciones_posteriores'" : "NULL") . ", " .
            "fich_resu = " . 
            (($updatedTask->fich_resu !== null && $updatedTask->fich_resu != '') ? "'$updatedTask->fich_resu'" : "NULL") . ", " .
            "foto = " . 
            (($updatedTask->foto !== null && $updatedTask->foto != '') ? "'$updatedTask->foto'" : "NULL") . "
            WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

    public static function deleteTask($id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "DELETE FROM task 
        WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

    public static function getOperarios()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT id, usuario, password, 
        FROM operario,
        WHERE status = 'O'";
        $result = $db->conn->query($sql);
        return $result;
    }

    public static function checkUser($user, $pass)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT usuario, password, status
        FROM usuarios
        WHERE usuario = '$user' AND password = '$pass'";
        $result = $db->conn->query($sql);
        $user = $result->fetch(\PDO::FETCH_ASSOC);
        return ($user) ? true : false;
    }

    public static function getUser($user, $pass)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT usuario, password, status
        FROM usuarios
        WHERE usuario = '$user' AND password = '$pass'";
        $result = $db->conn->query($sql);
        $user = $result->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public static function deleteFicheros($campo, $id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "UPDATE task 
        SET $campo = NULL
        WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

}
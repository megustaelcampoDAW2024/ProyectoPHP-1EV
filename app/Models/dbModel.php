<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SingletonDB;
use PDO;

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

    public static function getTasksByPage($limit, $offset)
    {
        $db = SingletonDB::getInstance();
        $stmt = $db->conn->prepare('SELECT task_id, nombre, apell, descripcion, estado, fecha_creacion, fecha_realizacion 
        FROM task 
        ORDER BY fecha_creacion 
        DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tasks as &$task) {
            $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            if($task['fecha_realizacion'] != null){
                $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
            }
        }
        return $tasks;
    }

    public static function countTasks()
    {
        $db = SingletonDB::getInstance();
        $stmt = $db->conn->query('SELECT COUNT(*) FROM task');
        return $stmt->fetchColumn();
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
            if($task['fecha_creacion'] != null) {
                $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            }
            if($task['fecha_realizacion'] != null) {
                $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
            }
        }
        return $task;
    }

    public static function countFilteredTasks($filters)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT COUNT(*) FROM task WHERE 1=1";
    
        if ($filters['estado']) {
            $sql .= " AND estado = '{$filters['estado']}'";
        }
        if ($filters['id']) {
            $sql .= " AND task_id {$filters['idCriterio']} {$filters['id']}";
        }
        if ($filters['fechaCreacion']) {
            $sql .= " AND fecha_creacion {$filters['fechaCreacionCriterio']} '{$filters['fechaCreacion']}'";
        }
        if ($filters['fechaRealizacion']) {
            $sql .= " AND fecha_realizacion {$filters['fechaRealizacionCriterio']} '{$filters['fechaRealizacion']}'";
        }
    
        $stmt = $db->conn->query($sql);
        return $stmt->fetchColumn();
    }
    
    public static function getFilteredTasks($limit, $offset, $filters)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT * 
        FROM task 
        WHERE 1=1";
        if ($filters['estado']) {
            $sql .= " AND estado = '{$filters['estado']}'";
        }
        if ($filters['id']) {
            $sql .= " AND task_id {$filters['idCriterio']} {$filters['id']}";
        }
        if ($filters['fechaCreacion']) {
            $sql .= " AND fecha_creacion {$filters['fechaCreacionCriterio']} '{$filters['fechaCreacion']}'";
        }
        if ($filters['fechaRealizacion']) {
            $sql .= " AND fecha_realizacion {$filters['fechaRealizacionCriterio']} '{$filters['fechaRealizacion']}'";
        }
    
        $sql .= " ORDER BY fecha_creacion DESC LIMIT :limit OFFSET :offset";
        $stmt = $db->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($tasks as &$task) {
            $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            if ($task['fecha_realizacion'] != null) {
                $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
            }
        }
    
        return $tasks;
    }

    public static function getProvincias()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT cod, nombre, comunidad_id
        FROM tbl_provincias
        ORDER BY nombre";
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

    public static function getUsuarios()
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT * FROM usuarios";
        $result = $db->conn->query($sql);
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function crearUsuario($usuario, $password, $status)
    {
        $db = SingletonDB::getInstance();
        $sql = "INSERT INTO usuarios (usuario, password, status) VALUES ('$usuario', '$password', '$status')";
        $db->conn->query($sql);
    }

    public static function getUsuarioById($id)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $result = $db->conn->query($sql);
        return $result->fetch(\PDO::FETCH_OBJ);
    }

    public static function editarUsuario($id, $usuario, $password, $status)
    {
        $db = SingletonDB::getInstance();
        $sql = "UPDATE usuarios SET usuario = '$usuario', password = '$password', status = '$status' WHERE id = $id";
        $db->conn->query($sql);
    }

    public static function eliminarUsuario($id)
    {
        $db = SingletonDB::getInstance();
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $db->conn->query($sql);
    }

}
<?php

namespace App\Models;

use App\Models\Utiles;

class Task
{
    public $num_fiscal_cliente;
    public $nombre, $apell, $tlf, $email;
    public $descripcion;
    public $direccion, $poblacion, $codigo_post, $provincia;
    public $estado;
    public $fecha_creacion, $fecha_realizacion;
    public $operario;
    public $anotaciones_anteriores, $anotaciones_posteriores;
    public $fich_resu, $foto;

    public function __construct()
    {
        $this->num_fiscal_cliente = strtoupper(Utiles::ValorPost('num-fiscal-cliente'));
        $this->nombre = Utiles::ValorPost('nombre');
        $this->apell = Utiles::ValorPost('apell');
        $this->tlf = Utiles::ValorPost('tlf');
        $this->descripcion = Utiles::ValorPost('descripcion');
        $this->email = Utiles::ValorPost('email');
        $this->direccion = Utiles::ValorPost('direccion');
        $this->poblacion = Utiles::ValorPost('poblacion');
        $this->codigo_post = Utiles::ValorPost('codigo-post');
        $this->provincia = Utiles::ValorPost('provincia');
        $this->estado = Utiles::ValorPost('estado');
        $this->fecha_creacion = date('Y-m-d H:i:s', strtotime(Utiles::ValorPost('fecha-creacion')));
        $this->operario = Utiles::ValorPost('operario');
        $this->fecha_realizacion = (Utiles::ValorPost('fecha-realizacion') == '')? "N/A" : date('d-m-Y', strtotime(Utiles::ValorPost('fecha-realizacion')));
        $this->anotaciones_anteriores = Utiles::ValorPost('anotaciones-anteriores');
        $this->anotaciones_posteriores = Utiles::ValorPost('anotaciones-posteriores');
        $this->fich_resu = Utiles::ValorPost('fich-resu');
        $this->foto = Utiles::ValorPost('foto');
    }
}
?>
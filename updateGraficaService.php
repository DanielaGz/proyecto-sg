<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/LogUsuario.php");
require("business/Usuario.php");
require("business/UsuarioDashboard.php");
require("business/Dashboard.php");
require("business/Grafica.php");
require("business/CategoriaRa.php");
require("business/Bloom.php");
require("business/ResultadoAprendizaje.php");
require("business/Estrategia.php");
require("business/EstrategiaCriterio.php");
require("business/Criterio.php");
require("business/Calificacion.php");
require_once("persistence/Connection.php");
$id = $_GET['id'];

if (isset($_POST['update'])) {
    $grafica = new Grafica($id);
    $grafica -> select();
    if ($_POST['posicion']){
        $graficaUpdate = new Grafica(
            $id, 
            $grafica -> getNombre(), 
            $grafica -> getDetalle(), 
            $grafica -> getConfig(), 
            $grafica -> getPosicion(),
            $_POST['posicion'],
            $grafica -> getTam(),
            $grafica -> getDashboard() -> getIdDashboard()
            );
    }else if ($_POST['tam']){
        $graficaUpdate = new Grafica(
            $id, 
            $grafica -> getNombre(), 
            $grafica -> getDetalle(), 
            $grafica -> getConfig(), 
            $grafica -> getPosicion(),
            $grafica -> getPosicion(),
            $_POST['tam'],
            $grafica -> getDashboard() -> getIdDashboard()
            );
    }
    $graficaUpdate -> update();
}

if (isset($_POST['create'])) {
    $grafica = new Grafica("","","","","","","",$id);
    $graficas = $grafica -> selectAllByDashboard();
    $graficaUpdate = new Grafica(
        "", 
        $_POST['nombre'], 
        $_POST['detalle'], 
        $_POST['config'], 
        $_POST['fila'], 
        count($graficas)+1, 
        $_POST['tam'], 
        $id
    );
    $graficaUpdate -> insert();
}

if (isset($_POST['delete'])) {
    $grafica = new Grafica($id);
    $grafica -> delete();
}

?>
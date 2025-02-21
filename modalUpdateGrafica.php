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
$grafica = new Grafica($id);
$grafica -> select('posicion','asc');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $graficaUpdate = new Grafica(
        $id, 
        $_POST['nombre'], 
        $_POST['detalle'], 
        $_POST['typeG'],
        $_POST['section'],
        $grafica -> getPosicion(),
        $_POST['filas'],
        $grafica -> getDashboard() -> getIdDashboard()
        );
    $graficaUpdate -> update();
}
?>
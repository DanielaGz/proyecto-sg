<?php 
session_start();
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
ini_set("display_errors","1");
date_default_timezone_set("America/Bogota");
$webPagesNoAuthentication = array(
	'ui/recoverPassword.php',
);
$webPages = array(
	'ui/sessionAdministrator.php',
	'ui/administrator/insertAdministrator.php',
	'ui/administrator/updateAdministrator.php',
	'ui/administrator/selectAllAdministrator.php',
	'ui/administrator/searchAdministrator.php',
	'ui/administrator/updateProfileAdministrator.php',
	'ui/administrator/updatePasswordAdministrator.php',
	'ui/administrator/updateProfilePictureAdministrator.php',
	'ui/administrator/updatePictureAdministrator.php',
	'ui/logAdministrator/searchLogAdministrator.php',
	'ui/logUsuario/searchLogUsuario.php',
	'ui/sessionUsuario.php',
	'ui/general.php',
	'ui/usuario/insertUsuario.php',
	'ui/usuario/updateUsuario.php',
	'ui/usuario/selectAllUsuario.php',
	'ui/usuario/searchUsuario.php',
	'ui/usuario/updateProfileUsuario.php',
	'ui/usuario/updatePasswordUsuario.php',
	'ui/usuario/updateProfilePictureUsuario.php',
	'ui/usuarioDashboard/selectAllUsuarioDashboardByUsuario.php',
	'ui/usuario/updatePictureUsuario.php',
	'ui/usuarioDashboard/insertUsuarioDashboard.php',
	'ui/usuarioDashboard/updateUsuarioDashboard.php',
	'ui/usuarioDashboard/selectAllUsuarioDashboard.php',
	'ui/usuarioDashboard/searchUsuarioDashboard.php',
	'ui/dashboard/insertDashboard.php',
	'ui/dashboard/updateDashboard.php',
	'ui/dashboard/selectAllDashboard.php',
	'ui/dashboard/searchDashboard.php',
	'ui/dashboard/dashboardCustom.php',
	'ui/usuarioDashboard/selectAllUsuarioDashboardByDashboard.php',
	'ui/grafica/selectAllGraficaByDashboard.php',
	'ui/grafica/insertGrafica.php',
	'ui/grafica/updateGrafica.php',
	'ui/grafica/selectAllGrafica.php',
	'ui/grafica/searchGrafica.php',
	'ui/grafica/customGrapich.php',
	'ui/categoriaRa/insertCategoriaRa.php',
	'ui/categoriaRa/updateCategoriaRa.php',
	'ui/categoriaRa/selectAllCategoriaRa.php',
	'ui/categoriaRa/searchCategoriaRa.php',
	'ui/categoriaRa/dashboardCategoria.php',
	'ui/resultadoAprendizaje/selectAllResultadoAprendizajeByCategoriaRa.php',
	'ui/bloom/insertBloom.php',
	'ui/bloom/updateBloom.php',
	'ui/bloom/selectAllBloom.php',
	'ui/bloom/searchBloom.php',
	'ui/resultadoAprendizaje/insertResultadoAprendizaje.php',
	'ui/resultadoAprendizaje/updateResultadoAprendizaje.php',
	'ui/resultadoAprendizaje/selectAllResultadoAprendizaje.php',
	'ui/resultadoAprendizaje/searchResultadoAprendizaje.php',
	'ui/estrategia/selectAllEstrategiaByResultadoAprendizaje.php',
	'ui/estrategia/insertEstrategia.php',
	'ui/estrategia/updateEstrategia.php',
	'ui/estrategia/selectAllEstrategia.php',
	'ui/estrategia/searchEstrategia.php',
	'ui/estrategiaCriterio/selectAllEstrategiaCriterioByEstrategia.php',
	'ui/estrategiaCriterio/insertEstrategiaCriterio.php',
	'ui/estrategiaCriterio/updateEstrategiaCriterio.php',
	'ui/estrategiaCriterio/selectAllEstrategiaCriterio.php',
	'ui/estrategiaCriterio/searchEstrategiaCriterio.php',
	'ui/criterio/insertCriterio.php',
	'ui/criterio/updateCriterio.php',
	'ui/criterio/selectAllCriterio.php',
	'ui/criterio/searchCriterio.php',
	'ui/calificacion/selectAllCalificacionByCriterio.php',
	'ui/estrategiaCriterio/selectAllEstrategiaCriterioByCriterio.php',
	'ui/calificacion/insertCalificacion.php',
	'ui/calificacion/updateCalificacion.php',
	'ui/calificacion/selectAllCalificacion.php',
	'ui/calificacion/searchCalificacion.php',
	'ui/loader.php'
);
if(isset($_GET['logOut'])){
	$_SESSION['id']="";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SVRA</title>
		<title>SVRA</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/png" href="img/logo.png" />
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>
		<!-- <script src="assets/vendor/libs/sortablejs/sortable.js"></script> -->
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
		<script src="https://code.highcharts.com/modules/accessibility.js"></script>
		<script src="https://code.highcharts.com/modules/treemap.js"></script>
		<script src="https://code.highcharts.com/modules/treegraph.js"></script>
		<script src="https://code.highcharts.com/highcharts-more.js"></script>
		<script src="https://code.highcharts.com/modules/networkgraph.js"></script>
		<script src="https://code.highcharts.com/modules/sankey.js"></script>
		<script src="https://code.highcharts.com/modules/dependency-wheel.js"></script>
		<script src="https://code.highcharts.com/highcharts-more.js"></script>
		<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

		<script type="text/javascript" src="core/config/config.js"></script>
		<script type="text/javascript" src="core/config/createChart.js"></script>
		<script charset="utf-8">
			$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
		<style>
			body{
				background-color: #e9ecef;
			}

			.round{
				border-radius: 20px !important;
			}

			.h-full{
				height: 100%;
			}

			/* Estilos adicionales para los elementos del grid */
			.elemento {
				border: 1px solid #ccc;
				padding: 10px;
				margin-bottom: 10px;
				position: relative; /* Para posicionar correctamente el botón de cerrar */
			}

			/* Estilos para el botón de cerrar */
			.close {
				position: absolute;
				right: 5px;
				top: 5px;
				z-index: 999;
			}

			.grid-item {
				cursor: move;
			}

			.not-draggable {
				cursor: default;
			}

			.tilt {
				animation: tilt 0.15s infinite alternate;
			}

			@keyframes tilt {
				0% { transform: rotate(0.3deg); }
				100% { transform: rotate(-0.3deg); }
			}

			.round-left {
				border-radius: 16px 0px 0px 16px;
			}

			.round-right {
				border-radius: 0px 16px 16px 0px;
			}

			.round-top, .card-header{
				border-radius: 20px 20px 0px 0px !important;
			}

			input, button, select, .card {
				border-radius: 20px !important;
			}

			.container-sticky{
				position: sticky;
				z-index: 10;
				top: 4rem;
			}
		</style>
	</head>
	<body>
		<?php
		if(empty($_GET['pid'])){
			include('ui/home.php' );
		}else{
			$pid=base64_decode($_GET['pid']);
			if(in_array($pid, $webPagesNoAuthentication)){
				include($pid);
			}else{
				if($_SESSION['id']==""){
					header("Location: index.php");
					die();
				}
				if($_SESSION['entity']=="Administrator"){
					include('ui/menuAdministrator.php');
				}
				if($_SESSION['entity']=="Usuario"){
					include('ui/menuUsuario.php');
				}
				if (in_array($pid, $webPages)){
					include($pid);
				}else{
					include('ui/error.php');
				}
			}
		}
		?>
		<!-- <div class="text-center text-muted">ITI &copy; <?php echo date("Y")?></div> -->
	</body>
</html>

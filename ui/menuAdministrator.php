<?php
$administrator = new Administrator($_SESSION['id']);
$administrator -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrator.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/insertAdministrator.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/usuario/insertUsuario.php") ?>">Usuario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/dashboard/insertDashboard.php") ?>">Tablero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/grafica/insertGrafica.php") ?>">Gráfica</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/categoriaRa/insertCategoriaRa.php") ?>">Categoría Ra</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/bloom/insertBloom.php") ?>">Bloom</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/resultadoAprendizaje/insertResultadoAprendizaje.php") ?>">Resultado Aprendizaje</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/estrategia/insertEstrategia.php") ?>">Estrategia</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/criterio/insertCriterio.php") ?>">Criterio</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/calificacion/insertCalificacion.php") ?>">Calificación</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Consultar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/usuario/selectAllUsuario.php") ?>">Usuario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/dashboard/selectAllDashboard.php") ?>">Tablero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/grafica/selectAllGrafica.php") ?>">Gráfica</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/categoriaRa/selectAllCategoriaRa.php") ?>">Categoría Ra</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/bloom/selectAllBloom.php") ?>">Bloom</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/resultadoAprendizaje/selectAllResultadoAprendizaje.php") ?>">Resultado Aprendizaje</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/estrategia/selectAllEstrategia.php") ?>">Estrategia</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/criterio/selectAllCriterio.php") ?>">Criterio</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/calificacion/selectAllCalificacion.php") ?>">Calificación</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Buscar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/searchAdministrator.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/usuario/searchUsuario.php") ?>">Usuario</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/dashboard/searchDashboard.php") ?>">Tablero</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/grafica/searchGrafica.php") ?>">Gráfica</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/categoriaRa/searchCategoriaRa.php") ?>">Categoría Ra</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/bloom/searchBloom.php") ?>">Bloom</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/resultadoAprendizaje/searchResultadoAprendizaje.php") ?>">Resultado Aprendizaje</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/estrategia/searchEstrategia.php") ?>">Estrategia</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/criterio/searchCriterio.php") ?>">Criterio</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/calificacion/searchCalificacion.php") ?>">Calificación</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Logs</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logAdministrator/searchLogAdministrator.php") ?>">Log Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logUsuario/searchLogUsuario.php") ?>">Log Usuario</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Administrator: <?php echo $administrator -> getName() . " " . $administrator -> getLastName() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfileAdministrator.php") ?>">Editar perfil</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updatePasswordAdministrator.php") ?>">Editar contraseña</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfilePictureAdministrator.php") ?>">Editar foto</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Cerrar sesión</a>
			</li>
		</ul>
	</div>
</nav>

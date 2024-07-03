<?php
$usuario = new Usuario($_SESSION['id']);
$usuario -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionUsuario.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Consultar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/categoriaRa/selectAllCategoriaRa.php") ?>">Categorías</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/bloom/selectAllBloom.php") ?>">Bloom</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/resultadoAprendizaje/selectAllResultadoAprendizaje.php") ?>">Resultados de aprendizaje</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/estrategia/selectAllEstrategia.php") ?>">Estrategias</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/criterio/selectAllCriterio.php") ?>">Criterios</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/calificacion/selectAllCalificacion.php") ?>">Calificaciones</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Dashboard</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode('ui/categoriaRa/dashboardCategoria.php') ?>">Categorias</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode('ui/dashboard/dashboardCustom.php') ?>">Personalizado</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">Usuario: <?php echo $usuario -> getName() . " " . $usuario -> getLastName() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/usuario/updateProfileUsuario.php") ?>">Edit Profile</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/usuario/updatePasswordUsuario.php") ?>">Edit Password</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/usuario/updateProfilePictureUsuario.php") ?>">Edit Picture</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Log Out</a>
			</li>
		</ul>
	</div>
</nav>

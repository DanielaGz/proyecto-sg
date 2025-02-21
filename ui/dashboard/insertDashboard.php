<?php
$processed=false;
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$detalle="";
if(isset($_POST['detalle'])){
	$detalle=$_POST['detalle'];
}
$usuario="";
if(isset($_POST['usuario'])){
	$usuario=$_POST['usuario'];
}

$url = base64_encode("ui/dashboard/insertDashboard.php");
if(isset($_GET['usuario'])){
	$usuario=$_GET['usuario'];
	$url .= '&usuario='.$_SESSION['id'];
}
if(isset($_POST['insert'])){
	$newDashboard = new Dashboard("", $nombre, $detalle, $usuario);
	$newDashboard -> insert();
	$user_ip = getenv('REMOTE_ADDR');
	$agent = $_SERVER["HTTP_USER_AGENT"];
	$browser = "-";
	if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
		$browser = "Internet Explorer";
	} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Chrome";
	} else if (preg_match('/Edge\/\d+/', $agent) ) {
		$browser = "Edge";
	} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Firefox";
	} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Opera";
	} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Safari";
	}
	if($_SESSION['entity'] == 'Administrator'){
		$logAdministrator = new LogAdministrator("","Crear Tablero", "Nombre: " . $nombre . "; Detalle: " . $detalle, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Crear Tablero", "Nombre: " . $nombre . "; Detalle: " . $detalle, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logUsuario -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Crear tablero</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Tablero actualizado
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo $url ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $detalle ?>"/>
						</div>
						<?php if(!isset($_GET['usuario'])){ ?>
						<div class="form-group">
							<label>Usuario*</label>
							<select class="form-control" name="usuario">
								<?php
								$objUsuario = new Usuario();
								$usuarios = $objUsuario -> selectAllOrder("name", "asc");
								foreach($usuarios as $currentUsuario){
									echo "<option value='" . $currentUsuario -> getIdUsuario() . "'";
									if($currentUsuario -> getIdUsuario() == $usuario){
										echo " selected";
									}
									echo ">" . $currentUsuario -> getName() . "</option>";
								}
								?>
							</select>
						</div>
						<?php } ?>
						<button type="submit" class="btn btn-secondary" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

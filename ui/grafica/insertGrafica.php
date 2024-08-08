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
$config="";
if(isset($_POST['config'])){
	$config=$_POST['config'];
}
$fila="";
if(isset($_POST['fila'])){
	$fila=$_POST['fila'];
}
$posicion="";
if(isset($_POST['posicion'])){
	$posicion=$_POST['posicion'];
}
$tam="";
if(isset($_POST['tam'])){
	$tam=$_POST['tam'];
}
$dashboard="";
if(isset($_POST['dashboard'])){
	$dashboard=$_POST['dashboard'];
}
if(isset($_GET['idDashboard'])){
	$dashboard=$_GET['idDashboard'];
}
if(isset($_POST['insert'])){
	$newGrafica = new Grafica("", $nombre, $detalle, $config, $fila, $posicion, $tam, $dashboard);
	$newGrafica -> insert();
	$objDashboard = new Dashboard($dashboard);
	$objDashboard -> select();
	$nameDashboard = $objDashboard -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Crear Gráfica", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Config: " . $config . "; Fila: " . $fila . "; Posicion: " . $posicion . "; Tam: " . $tam . "; Dashboard: " . $nameDashboard , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Crear Gráfica", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Config: " . $config . "; Fila: " . $fila . "; Posicion: " . $posicion . "; Tam: " . $tam . "; Dashboard: " . $nameDashboard , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Gráfica</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Información almacenada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/grafica/insertGrafica.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $detalle ?>"/>
						</div>
						<div class="form-group">
							<label>Config*</label>
							<input type="text" class="form-control" name="config" value="<?php echo $config ?>" required />
						</div>
						<div class="form-group">
							<label>Fila*</label>
							<input type="text" class="form-control" name="fila" value="<?php echo $fila ?>" required />
						</div>
						<div class="form-group">
							<label>Posicion*</label>
							<input type="text" class="form-control" name="posicion" value="<?php echo $posicion ?>" required />
						</div>
						<div class="form-group">
							<label>Tamaño</label>
							<input type="text" class="form-control" name="tam" value="<?php echo $tam ?>"/>
						</div>
						<div class="form-group">
							<label>Dashboard*</label>
							<select class="form-control" name="dashboard">
								<?php
								$objDashboard = new Dashboard();
								$dashboards = $objDashboard -> selectAllOrder("nombre", "asc");
								foreach($dashboards as $currentDashboard){
									echo "<option value='" . $currentDashboard -> getIdDashboard() . "'";
									if($currentDashboard -> getIdDashboard() == $dashboard){
										echo " selected";
									}
									echo ">" . $currentDashboard -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-info" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$processed=false;
$idCalificacion = $_GET['idCalificacion'];
$updateCalificacion = new Calificacion($idCalificacion);
$updateCalificacion -> select();
$nivel="";
if(isset($_POST['nivel'])){
	$nivel=$_POST['nivel'];
}
$detalle="";
if(isset($_POST['detalle'])){
	$detalle=$_POST['detalle'];
}
$criterio="";
if(isset($_POST['criterio'])){
	$criterio=$_POST['criterio'];
}
if(isset($_POST['update'])){
	$updateCalificacion = new Calificacion($idCalificacion, $nivel, $detalle, $criterio);
	$updateCalificacion -> update();
	$updateCalificacion -> select();
	$objCriterio = new Criterio($criterio);
	$objCriterio -> select();
	$nameCriterio = $objCriterio -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Editar Calificación", "Nivel: " . $nivel . "; Detalle: " . $detalle . "; Criterio: " . $nameCriterio , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Editar Calificación", "Nivel: " . $nivel . "; Detalle: " . $detalle . "; Criterio: " . $nameCriterio , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Calificación</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Información actualizada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/calificacion/updateCalificacion.php") . "&idCalificacion=" . $idCalificacion ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nivel*</label>
							<input type="text" class="form-control" name="nivel" value="<?php echo $updateCalificacion -> getNivel() ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $updateCalificacion -> getDetalle() ?>"/>
						</div>
						<div class="form-group">
							<label>Criterio*</label>
							<select class="form-control" name="criterio">
								<?php
								$objCriterio = new Criterio();
								$criterios = $objCriterio -> selectAllOrder("nombre", "asc");
								foreach($criterios as $currentCriterio){
									echo "<option value='" . $currentCriterio -> getIdCriterio() . "'";
									if($currentCriterio -> getIdCriterio() == $updateCalificacion -> getCriterio() -> getIdCriterio()){
										echo " selected";
									}
									echo ">" . $currentCriterio -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-secondary" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

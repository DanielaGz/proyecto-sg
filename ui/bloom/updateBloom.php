<?php
$processed=false;
$idBloom = $_GET['idBloom'];
$updateBloom = new Bloom($idBloom);
$updateBloom -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$detalle="";
if(isset($_POST['detalle'])){
	$detalle=$_POST['detalle'];
}
$resultadoAprendizaje="";
if(isset($_POST['resultadoAprendizaje'])){
	$resultadoAprendizaje=$_POST['resultadoAprendizaje'];
}
if(isset($_POST['update'])){
	$updateBloom = new Bloom($idBloom, $nombre, $detalle, $resultadoAprendizaje);
	$updateBloom -> update();
	$updateBloom -> select();
	$objResultadoAprendizaje = new ResultadoAprendizaje($resultadoAprendizaje);
	$objResultadoAprendizaje -> select();
	$nameResultadoAprendizaje = $objResultadoAprendizaje -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Edit Bloom", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Resultado Aprendizaje: " . $nameResultadoAprendizaje , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Edit Bloom", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Resultado Aprendizaje: " . $nameResultadoAprendizaje , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Edit Bloom</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/bloom/updateBloom.php") . "&idBloom=" . $idBloom ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateBloom -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $updateBloom -> getDetalle() ?>"/>
						</div>
						<div class="form-group">
							<label>Resultado Aprendizaje*</label>
							<select class="form-control" name="resultadoAprendizaje">
								<?php
								$objResultadoAprendizaje = new ResultadoAprendizaje();
								$resultadoAprendizajes = $objResultadoAprendizaje -> selectAllOrder("nombre", "asc");
								foreach($resultadoAprendizajes as $currentResultadoAprendizaje){
									echo "<option value='" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "'";
									if($currentResultadoAprendizaje -> getIdResultadoAprendizaje() == $updateBloom -> getResultadoAprendizaje() -> getIdResultadoAprendizaje()){
										echo " selected";
									}
									echo ">" . $currentResultadoAprendizaje -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-info" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

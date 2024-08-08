<?php
$processed=false;
$idEstrategia = $_GET['idEstrategia'];
$updateEstrategia = new Estrategia($idEstrategia);
$updateEstrategia -> select();
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
	$updateEstrategia = new Estrategia($idEstrategia, $nombre, $detalle, $resultadoAprendizaje);
	$updateEstrategia -> update();
	$updateEstrategia -> select();
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
		$logAdministrator = new LogAdministrator("","Editar Estrategia", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Resultado Aprendizaje: " . $nameResultadoAprendizaje , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Editar Estrategia", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Resultado Aprendizaje: " . $nameResultadoAprendizaje , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Estrategia</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Información actualizada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/estrategia/updateEstrategia.php") . "&idEstrategia=" . $idEstrategia ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateEstrategia -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $updateEstrategia -> getDetalle() ?>"/>
						</div>
						<div class="form-group">
							<label>Resultado Aprendizaje*</label>
							<select class="form-control" name="resultadoAprendizaje">
								<?php
								$objResultadoAprendizaje = new ResultadoAprendizaje();
								$resultadoAprendizajes = $objResultadoAprendizaje -> selectAllOrder("nombre", "asc");
								foreach($resultadoAprendizajes as $currentResultadoAprendizaje){
									echo "<option value='" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "'";
									if($currentResultadoAprendizaje -> getIdResultadoAprendizaje() == $updateEstrategia -> getResultadoAprendizaje() -> getIdResultadoAprendizaje()){
										echo " selected";
									}
									echo ">" . $currentResultadoAprendizaje -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

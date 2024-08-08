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
$resultadoAprendizaje="";
if(isset($_POST['resultadoAprendizaje'])){
	$resultadoAprendizaje=$_POST['resultadoAprendizaje'];
}
if(isset($_GET['idResultadoAprendizaje'])){
	$resultadoAprendizaje=$_GET['idResultadoAprendizaje'];
}
if(isset($_POST['insert'])){
	$newEstrategia = new Estrategia("", $nombre, $detalle, $resultadoAprendizaje);
	$newEstrategia -> insert();
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
		$logAdministrator = new LogAdministrator("","Create Estrategia", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Resultado Aprendizaje: " . $nameResultadoAprendizaje , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Create Estrategia", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Resultado Aprendizaje: " . $nameResultadoAprendizaje , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Estrategia</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Información almacenada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/estrategia/insertEstrategia.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $detalle ?>"/>
						</div>
						<div class="form-group">
							<label>Resultado Aprendizaje*</label>
							<select class="form-control" name="resultadoAprendizaje">
								<?php
								$objResultadoAprendizaje = new ResultadoAprendizaje();
								$resultadoAprendizajes = $objResultadoAprendizaje -> selectAllOrder("nombre", "asc");
								foreach($resultadoAprendizajes as $currentResultadoAprendizaje){
									echo "<option value='" . $currentResultadoAprendizaje -> getIdResultadoAprendizaje() . "'";
									if($currentResultadoAprendizaje -> getIdResultadoAprendizaje() == $resultadoAprendizaje){
										echo " selected";
									}
									echo ">" . $currentResultadoAprendizaje -> getNombre() . "</option>";
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

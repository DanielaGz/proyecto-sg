<?php
$processed=false;
$idResultadoAprendizaje = $_GET['idResultadoAprendizaje'];
$updateResultadoAprendizaje = new ResultadoAprendizaje($idResultadoAprendizaje);
$updateResultadoAprendizaje -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$detalle="";
if(isset($_POST['detalle'])){
	$detalle=$_POST['detalle'];
}
$bloom="";
if(isset($_POST['bloom'])){
	$bloom=$_POST['bloom'];
}
$categoriaRa="";
if(isset($_POST['categoriaRa'])){
	$categoriaRa=$_POST['categoriaRa'];
}
if(isset($_POST['update'])){
	$updateResultadoAprendizaje = new ResultadoAprendizaje($idResultadoAprendizaje, $nombre, $detalle, $bloom, $categoriaRa);
	$updateResultadoAprendizaje -> update();
	$updateResultadoAprendizaje -> select();
	$objBloom = new Bloom($bloom);
	$objBloom -> select();
	$nameBloom = $objBloom -> getNombre() ;
	$objCategoriaRa = new CategoriaRa($categoriaRa);
	$objCategoriaRa -> select();
	$nameCategoriaRa = $objCategoriaRa -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Editar Resultado Aprendizaje", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Bloom: " . $nameBloom . ";; Categoria Ra: " . $nameCategoriaRa , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Editar Resultado Aprendizaje", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Bloom: " . $nameBloom . ";; Categoria Ra: " . $nameCategoriaRa , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Resultado Aprendizaje</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Información actualizada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/resultadoAprendizaje/updateResultadoAprendizaje.php") . "&idResultadoAprendizaje=" . $idResultadoAprendizaje ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateResultadoAprendizaje -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $updateResultadoAprendizaje -> getDetalle() ?>"/>
						</div>
						<div class="form-group">
							<label>Bloom*</label>
							<select class="form-control" name="bloom">
								<?php
								$objBloom = new Bloom();
								$blooms = $objBloom -> selectAllOrder("nombre", "asc");
								foreach($blooms as $currentBloom){
									echo "<option value='" . $currentBloom -> getIdBloom() . "'";
									if($currentBloom -> getIdBloom() == $updateResultadoAprendizaje -> getBloom() -> getIdBloom()){
										echo " selected";
									}
									echo ">" . $currentBloom -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Categoria Ra*</label>
							<select class="form-control" name="categoriaRa">
								<?php
								$objCategoriaRa = new CategoriaRa();
								$categoriaRas = $objCategoriaRa -> selectAllOrder("nombre", "asc");
								foreach($categoriaRas as $currentCategoriaRa){
									echo "<option value='" . $currentCategoriaRa -> getIdCategoriaRa() . "'";
									if($currentCategoriaRa -> getIdCategoriaRa() == $updateResultadoAprendizaje -> getCategoriaRa() -> getIdCategoriaRa()){
										echo " selected";
									}
									echo ">" . $currentCategoriaRa -> getNombre() . "</option>";
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

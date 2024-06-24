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
$bloom="";
if(isset($_POST['bloom'])){
	$bloom=$_POST['bloom'];
}
if(isset($_GET['idBloom'])){
	$bloom=$_GET['idBloom'];
}
$categoriaRa="";
if(isset($_POST['categoriaRa'])){
	$categoriaRa=$_POST['categoriaRa'];
}
if(isset($_GET['idCategoriaRa'])){
	$categoriaRa=$_GET['idCategoriaRa'];
}
if(isset($_POST['insert'])){
	$newResultadoAprendizaje = new ResultadoAprendizaje("", $nombre, $detalle, $bloom, $categoriaRa);
	$newResultadoAprendizaje -> insert();
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
		$logAdministrator = new LogAdministrator("","Create Resultado Aprendizaje", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Bloom: " . $nameBloom . ";; Categoria Ra: " . $nameCategoriaRa , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Create Resultado Aprendizaje", "Nombre: " . $nombre . "; Detalle: " . $detalle . "; Bloom: " . $nameBloom . ";; Categoria Ra: " . $nameCategoriaRa , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Resultado Aprendizaje</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/resultadoAprendizaje/insertResultadoAprendizaje.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Detalle</label>
							<input type="text" class="form-control" name="detalle" value="<?php echo $detalle ?>"/>
						</div>
						<div class="form-group">
							<label>Bloom*</label>
							<select class="form-control" name="bloom">
								<?php
								$objBloom = new Bloom();
								$blooms = $objBloom -> selectAllOrder("nombre", "asc");
								foreach($blooms as $currentBloom){
									echo "<option value='" . $currentBloom -> getIdBloom() . "'";
									if($currentBloom -> getIdBloom() == $bloom){
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
									if($currentCategoriaRa -> getIdCategoriaRa() == $categoriaRa){
										echo " selected";
									}
									echo ">" . $currentCategoriaRa -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-info" name="insert">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

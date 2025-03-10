<?php
$processed=false;
$estrategia="";
if(isset($_POST['estrategia'])){
	$estrategia=$_POST['estrategia'];
}
if(isset($_GET['idEstrategia'])){
	$estrategia=$_GET['idEstrategia'];
}
$criterio="";
if(isset($_POST['criterio'])){
	$criterio=$_POST['criterio'];
}
if(isset($_GET['idCriterio'])){
	$criterio=$_GET['idCriterio'];
}
if(isset($_POST['insert'])){
	$newEstrategiaCriterio = new EstrategiaCriterio("", $estrategia, $criterio);
	$newEstrategiaCriterio -> insert();
	$objEstrategia = new Estrategia($estrategia);
	$objEstrategia -> select();
	$nameEstrategia = $objEstrategia -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Crear Estrategia Criterio", "Estrategia: " . $nameEstrategia . ";; Criterio: " . $nameCriterio , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Crear Estrategia Criterio", "Estrategia: " . $nameEstrategia . ";; Criterio: " . $nameCriterio , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Crear Estrategia Criterio</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Información almacenada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/estrategiaCriterio/insertEstrategiaCriterio.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Estrategia*</label>
							<select class="form-control" name="estrategia">
								<?php
								$objEstrategia = new Estrategia();
								$estrategias = $objEstrategia -> selectAllOrder("nombre", "asc");
								foreach($estrategias as $currentEstrategia){
									echo "<option value='" . $currentEstrategia -> getIdEstrategia() . "'";
									if($currentEstrategia -> getIdEstrategia() == $estrategia){
										echo " selected";
									}
									echo ">" . $currentEstrategia -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Criterio*</label>
							<select class="form-control" name="criterio">
								<?php
								$objCriterio = new Criterio();
								$criterios = $objCriterio -> selectAllOrder("nombre", "asc");
								foreach($criterios as $currentCriterio){
									echo "<option value='" . $currentCriterio -> getIdCriterio() . "'";
									if($currentCriterio -> getIdCriterio() == $criterio){
										echo " selected";
									}
									echo ">" . $currentCriterio -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-secondary" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

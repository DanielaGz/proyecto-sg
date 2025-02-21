<?php
$processed=false;
$idUsuarioDashboard = $_GET['idUsuarioDashboard'];
$updateUsuarioDashboard = new UsuarioDashboard($idUsuarioDashboard);
$updateUsuarioDashboard -> select();
$usuario="";
if(isset($_POST['usuario'])){
	$usuario=$_POST['usuario'];
}
$dashboard="";
if(isset($_POST['dashboard'])){
	$dashboard=$_POST['dashboard'];
}
if(isset($_POST['update'])){
	$updateUsuarioDashboard = new UsuarioDashboard($idUsuarioDashboard, $usuario, $dashboard);
	$updateUsuarioDashboard -> update();
	$updateUsuarioDashboard -> select();
	$objUsuario = new Usuario($usuario);
	$objUsuario -> select();
	$nameUsuario = $objUsuario -> getName() . " " . $objUsuario -> getLastName() ;
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
		$logAdministrator = new LogAdministrator("","Edit Usuario Dashboard", "Usuario: " . $nameUsuario . ";; Dashboard: " . $nameDashboard , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Edit Usuario Dashboard", "Usuario: " . $nameUsuario . ";; Dashboard: " . $nameDashboard , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Edit Usuario Dashboard</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/usuarioDashboard/updateUsuarioDashboard.php") . "&idUsuarioDashboard=" . $idUsuarioDashboard ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Usuario*</label>
							<select class="form-control" name="usuario">
								<?php
								$objUsuario = new Usuario();
								$usuarios = $objUsuario -> selectAllOrder("name", "asc");
								foreach($usuarios as $currentUsuario){
									echo "<option value='" . $currentUsuario -> getIdUsuario() . "'";
									if($currentUsuario -> getIdUsuario() == $updateUsuarioDashboard -> getUsuario() -> getIdUsuario()){
										echo " selected";
									}
									echo ">" . $currentUsuario -> getName() . " " . $currentUsuario -> getLastName() . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Dashboard*</label>
							<select class="form-control" name="dashboard">
								<?php
								$objDashboard = new Dashboard();
								$dashboards = $objDashboard -> selectAllOrder("nombre", "asc");
								foreach($dashboards as $currentDashboard){
									echo "<option value='" . $currentDashboard -> getIdDashboard() . "'";
									if($currentDashboard -> getIdDashboard() == $updateUsuarioDashboard -> getDashboard() -> getIdDashboard()){
										echo " selected";
									}
									echo ">" . $currentDashboard -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-secondary" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

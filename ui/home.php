<?php
$logInError=false;
$enabledError=false;
if(isset($_POST['logIn'])){
	if(isset($_POST['email']) && isset($_POST['password'])){
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
		$email=$_POST['email'];
		$password=$_POST['password'];
		$administrator = new Administrator();
		if($administrator -> logIn($email, $password)){
			if($administrator -> getState()==1){
				$_SESSION['id']=$administrator -> getIdAdministrator();
				$_SESSION['entity']="Administrator";
				$logAdministrator = new LogAdministrator("", "Inicio sesión", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $administrator -> getIdAdministrator());
				$logAdministrator -> insert();
				echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionAdministrator.php") . "'</script>"; 
			} else { 
				$enabledError=true; 
			}
		}
		$usuario = new Usuario();
		if($usuario -> logIn($email, $password)){
			if($usuario -> getState()==1){
				$_SESSION['id']=$usuario -> getIdUsuario();
				$_SESSION['entity']="Usuario";
				$logUsuario = new LogUsuario("", "Inicio sesión", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $usuario -> getIdUsuario());
				$logUsuario -> insert();
				echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionUsuario.php") . "'</script>"; 
			} else { 
				$enabledError=true; 
			}
		}
		$logInError=true;
	}
}
?>
<div align="center">
	<?php include("ui/header.php"); ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4><strong>Incia sesión</strong></h4>
				</div>
				<div class="card-body">
					<form id="form" method="post" action="index.php" class="bootstrap-form needs-validation"  >
						<div class="form-group">
							<div class="input-group" >
								<input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required />
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password" required />
						</div>
						<?php if($enabledError){
							echo "<div class='alert alert-danger' >User disabled</div>";
						} else if ($logInError){
							echo "<div class='alert alert-danger' >Wrong email or password</div>";
						} ?>
						<div class="form-group">
							<a href="index.php?pid=<?php echo base64_encode("ui/recoverPassword.php") ?>">Recuperar contraseña</a>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info" name="logIn">Iniciar sesión</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$logInError=false;
$enabledError=false;
$name="";
if(isset($_POST['name'])){
	$name=$_POST['name'];
}
$lastName="";
if(isset($_POST['lastName'])){
	$lastName=$_POST['lastName'];
}
$email="";
if(isset($_POST['email'])){
	$email=$_POST['email'];
}
$password="";
if(isset($_POST['password'])){
	$password=$_POST['password'];
}
$phone="";
if(isset($_POST['phone'])){
	$phone=$_POST['phone'];
}
$mobile="";
if(isset($_POST['mobile'])){
	$mobile=$_POST['mobile'];
}
if(isset($_POST['register'])){
	$newUsuario = new Usuario("", $name, $lastName, $email, $password, "", $phone, $mobile, 1);
	$id = $newUsuario -> insert();
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
	else if($_SESSION['entity'] == 'Usuario'){
		$logUsuario = new LogUsuario("","Registro", "Name: " . $name . "; Last Name: " . $lastName . "; Email: " . $email . "; Password: " . $password . "; Phone: " . $phone . "; Mobile: " . $mobile . "; State: " . $state, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $id);
		$logUsuario -> insert();
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
?>

<div class="login">
<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-5 p-0">
				<!-- <div class="card-header text-center">
					<h4><strong>Sistema web para la visualización científica de información sobre estrategias de enseñanza y su relación con los resultados de aprendizaje</strong></h4>
				</div> -->
				<div class="card-body">
							<div>
							<h4>Registro</h4>
                            <?php if($enabledError){
								echo "<div class='alert alert-danger' >User disabled</div>";
							} else if ($logInError){
								echo "<div class='alert alert-danger' >Wrong email or password</div>";
							} ?>
							<form id="form" method="post"  action="index.php?pid=<?php echo base64_encode("ui/register.php") ?>" class="bootstrap-form needs-validation"  >
                                <div class="form-group">
                                    <label>Nombre*</label>
                                    <input type="text" class="form-control" name="name" required />
                                </div>
                                <div class="form-group">
                                    <label>Apellido*</label>
                                    <input type="text" class="form-control" name="lastName" required />
                                </div>
                                <div class="form-group">
                                    <label>Correo*</label>
                                    <input type="email" class="form-control" name="email" required />
                                </div>
                                <div class="form-group">
                                    <label>Contraseña*</label>
                                    <input type="password" class="form-control" name="password" required />
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" name="phone"/>
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" class="form-control" name="mobile"/>
                                </div>
								<div class="form-group">
									<button type="submit" class="btn btn-secondary w-100" name="register">Registrarse</button>
								</div>
							</form>
							<hr>
							<p class="text-center">
							¿Ya tienes una cuenta? <a href="index.php">Inicia sesión</a>
							</p>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


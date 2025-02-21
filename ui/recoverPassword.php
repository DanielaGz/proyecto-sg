<?php
if(isset($_POST['recover'])){
	$foundEmail = false;
	$generatedPassword = "";
	if(!$foundEmail){
		$recoverAdministrator = new Administrator();
		if($recoverAdministrator -> existEmail($_POST['email'])) {;
			$generatedPassword = rand(100000,999999);
			$recoverAdministrator -> recoverPassword($_POST['email'], $generatedPassword);
		$foundEmail = true;
		}
	}
	if(!$foundEmail){
		$recoverUsuario = new Usuario();
		if($recoverUsuario -> existEmail($_POST['email'])) {;
			$generatedPassword = rand(100000,999999);
			$recoverUsuario -> recoverPassword($_POST['email'], $generatedPassword);
		$foundEmail = true;
		}
	}
	if($foundEmail){
		$to=$_POST['email'];
		$subject="Password recovery for SVRA";
		$from="FROM: SVRA <contact@itiud.org>";
		$message="Your new password is: ".$generatedPassword;
		mail($to, $subject, $message, $from);
	}
}
?>
<div class="login">
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<!-- <div class="card-header">
					<h4 class="card-title">Recuperar contraseña</h4>
				</div> -->
				<div class="card-body p-0">
				<div class="row">
						<div class="col-6 d-none d-lg-block p-0">
							<img src="img/login.jpeg" alt="login.jpeg" class="figure-img img-fluid round-left m-0">
						</div>
						<div class="col-12 col-lg-6 d-block d-lg-flex p-5 align-items-center">
						<div class="text-center">
						<h4>Recuperar contraseña</h4>
							<?php if(isset($_POST['recover'])) { ?>
							<div class="alert alert-success" >Si el correo: <em><?php echo $_POST['email'] ?></em> se encuentra en el sistema, una nueva contraseña fue enviada</div>
							<?php } else { ?>
							<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/recoverPassword.php") ?>" class="bootstrap-form needs-validation"   >
								<div class="form-group">
									<label>Correo*</label>
									<input type="email" class="form-control" name="email" required />
								</div>
								<div class="form-group">
									<a href="index.php">Iniciar sesión</a>
								</div>
								<button type="submit" class="btn btn-secondary" name="recover">Recuperar contraseña</button>
							</form>
							<?php } ?>
						</div>
					
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>


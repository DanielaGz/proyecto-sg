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
<div align="center">
	<?php include("ui/header.php"); ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Recover Password</h4>
				</div>
				<div class="card-body">
					<?php if(isset($_POST['recover'])) { ?>
					<div class="alert alert-success" >If the email: <em><?php echo $_POST['email'] ?></em> was found in the system, a new password was sent</div>
					<?php } else { ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/recoverPassword.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Email*</label>
							<input type="email" class="form-control" name="email" required />
						</div>
						<button type="submit" class="btn btn-info" name="recover">Recover Password</button>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

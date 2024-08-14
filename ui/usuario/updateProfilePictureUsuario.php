<?php
$processed=false;
$updateUsuario = new Usuario($_SESSION['id']);
$updateUsuario -> select();
$error = 0;
if(isset($_POST['update'])){
	$localPath=$_FILES['image']['tmp_name'];
	$type=$_FILES['image']['type'];
	if($type!="image/png" && $type!="image/jpg" && $type!="image/jpeg"){
		$error=1;
	} else {
		if (file_exists($updateUsuario -> getPicture())) {
			unlink($updateUsuario -> getPicture());
		}
		$serverPath = "image/" . time() . ".png";
		copy($localPath,$serverPath);
		$updateUsuario -> updateImagePicture($serverPath);
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
			$logAdministrator = new LogAdministrator("","Editar foto de perfil de Usuario", "Picture: " . $serverPath, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario'){
			$logUsuario = new LogUsuario("","Editar foto de perfil de Usuario", "Picture: " . $serverPath, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logUsuario -> insert();
		}
		$processed = true;
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Editar <i>foto</i> de Usuario</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" > Foto actualizada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 1) { ?>
					<div class="alert alert-danger" >Error. Imagen debe ser png.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/usuario/updateProfilePictureUsuario.php") ?>" class="bootstrap-form needs-validation" enctype="multipart/form-data"   >
						<div class="form-group">
							<label>Foto*</label>
							<input type="file" class="form-control-file" name="image" required />
						</div>
						<button type="submit" class="btn btn-secondary" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

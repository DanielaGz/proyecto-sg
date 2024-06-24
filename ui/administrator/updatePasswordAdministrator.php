<?php
$processed = false;
$error = 0;
if(isset($_POST['update'])){
	if($_POST['newPassword'] == $_POST['newPasswordConfirm']){
		$updateAdministrator = new Administrator($_SESSION['id']);
		$updateAdministrator -> select();
		if($updateAdministrator -> getPassword() == md5($_POST['currentPassword'])){
			$updateAdministrator -> updatePassword($_POST['newPassword']);
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
			$logAdministrator = new LogAdministrator("","Edit Password Administrator", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
			$processed = true;
		} else {
			$error = 2;
		}
	} else {
		$error = 1;
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Edit Password Administrator</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Password Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 1) { ?>
					<div class="alert alert-danger" >Error. <em>New Password</em> and <em>Confirm Password</em> fields must be equal
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 2) { ?>
					<div class="alert alert-danger" >Error. <em>Current Password</em> is wrong
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/administrator/updatePasswordAdministrator.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Current Password*</label>
							<input type="password" class="form-control" name="currentPassword" required />
						</div>
						<div class="form-group">
							<label>New Password*</label>
							<input type="password" class="form-control" name="newPassword" required />
						</div>
						<div class="form-group">
							<label>Confirm Password*</label>
							<input type="password" class="form-control" name="newPasswordConfirm" required />
						</div>
						<button type="submit" class="btn btn-info" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

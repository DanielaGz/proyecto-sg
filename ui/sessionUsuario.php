<?php
$usuario = new Usuario($_SESSION['id']);
$usuario -> select();
?>
<div class="container">
	<div>
		<div class="card-header">
			<h3>Profile</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo ($usuario -> getPicture()!="")?$usuario -> getPicture():"http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="rounded">
				</div>
				<div class="col-md-9">
					<div class="table-responsive-sm">
						<table class="table table-striped table-hover">
							<tr>
								<th>Name</th>
								<td><?php echo $usuario -> getName() ?></td>
							</tr>
							<tr>
								<th>Last Name</th>
								<td><?php echo $usuario -> getLastName() ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $usuario -> getEmail() ?></td>
							</tr>
							<tr>
								<th>Phone</th>
								<td><?php echo $usuario -> getPhone() ?></td>
							</tr>
							<tr>
								<th>Mobile</th>
								<td><?php echo $usuario -> getMobile() ?></td>
							</tr>
							<tr>
								<th>State</th>
								<td><?php echo ($usuario -> getState()==1)?"Enabled":"Disabled"; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
		<p><?php echo "Your role is: Usuario"; ?></p>
		</div>
	</div>
</div>

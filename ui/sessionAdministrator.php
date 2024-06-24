<?php
$administrator = new Administrator($_SESSION['id']);
$administrator -> select();
?>
<div class="container">
	<div>
		<div class="card-header">
			<h3>Profile</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo ($administrator -> getPicture()!="")?$administrator -> getPicture():"http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="rounded">
				</div>
				<div class="col-md-9">
					<div class="table-responsive-sm">
						<table class="table table-striped table-hover">
							<tr>
								<th>Name</th>
								<td><?php echo $administrator -> getName() ?></td>
							</tr>
							<tr>
								<th>Last Name</th>
								<td><?php echo $administrator -> getLastName() ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $administrator -> getEmail() ?></td>
							</tr>
							<tr>
								<th>Phone</th>
								<td><?php echo $administrator -> getPhone() ?></td>
							</tr>
							<tr>
								<th>Mobile</th>
								<td><?php echo $administrator -> getMobile() ?></td>
							</tr>
							<tr>
								<th>State</th>
								<td><?php echo ($administrator -> getState()==1)?"Enabled":"Disabled"; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
		<p><?php echo "Your role is: Administrator"; ?></p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12" style="margin-top:20px;">
		<div class="panel panel-primary">
			<div class="panel-heading clearfix">
				<a class="btn btn-warning btn-xs pull-right" href="<?php echo base_url("edit-profile/".$user[0]->id); ?>"><i class="fa fa-edit"></i> Edit Profile </a>
				<h1 class="panel-title"><i class="fa fa-user"></i> User Profile</h1>
			</div>
			<div class="panel-body">
				<fieldset>
					<legend>Personal Information</legend>
					<p><b>Name: </b><?php echo $user[0]->last_name. ", ". $user[0]->first_name. " ".$user[0]->middle_name; ?></p>
					<p><b>User Role: </b><?php echo $user[0]->name; ?> </p>
				</fieldset>
				<fieldset>
					<legend>User Credentials</legend>
					<p><b>Username:</b> <?php echo $user[0]->username; ?> </p>
					<p><b>Password:</b> ********* </p>
				</fieldset>
				<!-- <form class="form" > -->
					<!-- <div class="form-group"> -->
						
					<!-- </div> -->
				<!-- </form>-->
			</div>
		</div>
	</div>
</div>

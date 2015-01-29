<div class="row">
	<div class="col-lg-12" style="margin-top:20px;">
		<div class="panel panel-primary">
			<div class="panel-heading clearfix">
				<h1 class="panel-title"><i class="fa fa-user"></i> User Profile</h1>
			</div>
			<div class="panel-body">
				<div role="tabpanel">

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
						<li role="presentation" <?php echo (!isset($isActive))?"class='active'":"class='disabled'";?>  > <a href="#personal-information" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Personal Information</a></li>
						<li role="presentation" <?php echo (isset($isActive))?"class='active'":"";?> ><a href="#user-credentials" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-lock"></i> Change User Password</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="personal-information">
							<?php if(isset($isActive)): ?>
								<?php echo userCredentials($user); ?>
							<?php else: ?>
								<?php echo personalInformation($user); ?>
							<?php endif;?>
						</div>
						<div role="tabpanel" class="tab-pane" id="user-credentials">
							<?php  //if(!isset($isActive)): ?>
								<?php echo userCredentials($user); ?>
							<?php //else: ?>
								<?php //echo personalInformation($user); ?>
							<?php //endif;?>
						</div>
					  </div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
function personalInformation($user)
{
?>
	<form id="savePersonalInformation"  class="form" action="<?php echo base_url("save-personal-information"); ?>" method="POST" style="margin-top:20px;">
		<fieldset>
			<?php echo (isset($_GET['updateSuccess']) && $_GET['updateSuccess'] == true)?"<div class='alert alert-success'><i class='fa fa-check'></i> Update Personal Information Success!</div>":""; ?>
			<?php echo validation_errors(); ?>
			<input type="hidden" value="<?php echo $user->id; ?>" name="user_id"/>
			<div class="form-group">
				<label class="control-label">Last Name <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="text" name="lastname" placeholder="Last Name" value="<?php echo $user->last_name; ?>"/>
			</div> 
			<div class="form-group">
				<label class="control-label">First Name <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="text" name="firstname" placeholder="First Name" value="<?php echo $user->first_name; ?>"/>
			</div> 
			<div class="form-group">
				<label class="control-label">Middle Name <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="text" name="middlename" placeholder="Middle Name" value="<?php echo $user->middle_name; ?>"/>
			</div> 
			<div class="form-group">
				<label class="control-label">Username <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $user->username; ?>"/>
			</div> 
			<div class="form-group">
				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save Personal Information</button>
			</div>
		</fieldset>
	</form>
<?php
}
function userCredentials($user)
{
?>
	<form id="saveUserCredentials" class="form" action="<?php echo base_url("save-user-credentials"); ?>" method="POST" style="margin-top:20px;">
		<fieldset>
			<?php echo validation_errors(); ?>
			<input type="hidden" value="<?php echo $user->id; ?>" name="user_id"/>
			<div class="form-group">
				<label class="control-label">Old Password <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="password" name="oldpassword" placeholder="Password"/>
			</div> 
			<div class="form-group">
				<label class="control-label">New Password <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="password" name="newpassword" placeholder="Password"/>
			</div> 
			<div class="form-group">
				<label class="control-label">Confirm New Password <i class="fa fa-asterisk"></i></label>
				<input required class="form-control" type="password" name="cnpassword" placeholder="Confirm Password"/>
			</div> 
			<div class="form-group">
				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save User Credentials</button>
			</div>
		</fieldset>
	</form>
<?php
}
?>
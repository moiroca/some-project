
<div class="row">
  <div class="col-lg-12" style="margin-top:20px;">
     <!-- new form  -->
	<div class="panel panel-primary">
		<div class="panel-heading clearfix">
			<h1 class="panel-title"><i class="fa fa-edit"></i> Edit Office Secretary Personal Information</h1>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo base_url('update-office-secretary-password'); ?>">
				<fieldset>
					<?php echo validation_errors(); ?>
					<input type="hidden" value="<?php echo $user->id; ?>" name="user_id"/>
					<div class="form-group">
						<label class="control-label">New Password <i class="fa fa-asterisk"></i></label>
						<input required class="form-control" type="password" name="newpassword" placeholder="New Password"/>
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
		</div>
	</div>
   </div>
</div>

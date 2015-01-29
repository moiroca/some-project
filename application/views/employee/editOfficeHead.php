
<div class="row">
  <div class="col-lg-12" style="margin-top:20px;">
     <!-- new form  -->
	<div class="panel panel-primary">
		<div class="panel-heading clearfix">
			<a href=<?php echo base_url("edit-office-head-password/".$officeHead[0]->user_id); ?> class="btn btn-warning btn-xs pull-right"><i class="fa fa-lock"></i> Edit Office Head Password</a>
			<h1 class="panel-title"><i class="fa fa-edit"></i> Edit Office Head Personal Information</h1>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo base_url('editOfficeHead'); ?>">
				<input type="hidden" name="usersId" value="<?php echo $officeHead[0]->user_id;?>">
				<div class="form-group">
					<label class="control-label">Offices <i class="fa fa-asterisk"></i> </label>
					<?php if($offices): ?>
						<select class="form-control" required name="office_id">
							<option value="">-------Select Office-------</option>
							<?php foreach($offices as $key => $values): ?>
								<?php if ($officeHead[0]->office_id==$values->id){ ?>
									<option value="<?php echo $values->id; ?>" selected>
										<?php echo $values->description; ?>
									</option>
								<?php } else { ?>
									<option value="<?php echo $values->id; ?>">
										<?php echo $values->description; ?>
									</option>
								<?php }?>
								
							<?php endforeach; ?>
						</select>
					<?php else: ?>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<label class="control-label">Last Name <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="lastname" placeholder="Lastname" value="<?php echo $officeHead[0]->last_name; ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">First Name <i class="fa fa-asterisk"></i> </label>
					<input  class="form-control" type="text" id="name" name="firstname" placeholder="Firstname" value="<?php echo $officeHead[0]->first_name; ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">Middle Name <i class="fa fa-asterisk"></i> </label>
					<input  class="form-control" type="text" id="name" name="middlename" placeholder="Middlename" value="<?php echo $officeHead[0]->middle_name; ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">Username <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="lnu_id" placeholder="LNU ID" value="<?php echo $officeHead[0]->username; ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">
					<label class="control-label">
					 <input type="radio" value="1" id="male" name="status" <?php echo ($officeHead[0]->status == 1)? "checked":""; ?> />
					  <span> Active </span>
					 <input type="radio" value="0" id="male" name="status" <?php echo ($officeHead[0]->status == 0)? "checked":""; ?> />
					   <span> Inactive </span>
					</label>
				<div>
				 <button style="margin-top:10px;" type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Update </button>
			  </form>
		</div>
	</div>
   </div>
</div>

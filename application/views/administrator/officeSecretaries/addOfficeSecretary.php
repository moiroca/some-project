<div class="row">
  <div class="col-lg-12" style="margin-top:20px;">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h1 class="panel-title">New Office Secretary</h1>
		</div>
		<div class="panel-body">
			<?php echo validation_errors(); ?>
			<form method="POST" action=<?php echo base_url("addOfficeSecretary"); ?> class="form">
				<div class="form-group">
                  <input type="hidden" value="<?php echo $office_id; ?>" name="office_id" required />
                    <!-- <label class="control-label">Office <i class="fa fa-asterisk"></i> </label>
					<?php if(!empty($offices)): ?>
						<select required class="form-control" name="office_id">
							<option value="">Select Office</option>
							<?php foreach($offices as $key => $values): ?>
								<option value="<?php echo $values->id; ?>">
									<?php echo $values->description; ?>
								</option>
							<?php endforeach; ?>
						</select>
					<?php else: ?>
						<label class="label label-danger">Please Add Office</label>
					<?php endif; ?>
                    -->
				</div>
				<div class="form-group">
					<label class="control-label">Last Name <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="lastname" placeholder="Last Name" value="<?php echo set_value('lastname'); ?>" required />
				</div>
				<div class="form-group">
					<label class="control-label">First Name <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="firstname" placeholder="First Name"  value="<?php echo set_value('firstname'); ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">Middle Name <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="middlename" placeholder="Middle Name"  value="<?php echo set_value('middlename'); ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">LNU ID <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="lnu_id" placeholder="LNU ID"  value="<?php echo set_value('lnu_id'); ?>" required/>
				</div>
				<div class="form-group">
					<label class="control-label">
					 <input type="radio" value="1" id="male" name="status" checked />
					  <span> Active </span>
					 <input type="radio" value="0" id="male" name="status"/>
					   <span> Inactive </span>
					</label>
				</div>
				<button  type="submit" class="btn btn-success btn-s"> <i class="fa fa-save"></i> Save</button>
			  </form>
		</div>
	</div>
   </div>
</div>

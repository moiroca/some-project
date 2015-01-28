<div class="row">
  <div class="col-lg-12" style="margin-top:20px;">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h1 class="panel-title"> <i class="fa fa-building"></i> Create New Office </h1>
		</div>
		<div class="panel-body">
			<?php echo validation_errors(); ?>
			<form method="POST" action="<?php echo base_url("addOffice"); ?>">
				<div class="control-group">
					<label class="control-label">Office Name  <i class="fa fa-asterisk"></i> </label>
					<input class="form-control" type="text" id="name" name="description" placeholder="Name of Office" value="<?php echo set_value('description'); ?>" required/>
				</div>
				  <button style="margin-top:20px;" type="submit" class="btn btn-success btn-s"><i class="fa fa-save"></i> Save </button>
			  </form>
		</div>
	</div>
   </div>
</div>

<div class="row">
	<div class="col-lg-12"  style="margin-top:20px;">
    	<div class="panel panel-primary">
			<div class="panel-heading">
				 <h1 class="panel-title">Office Heads</h1>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-condensed table-striped table-bordered" >
					<thead>
					<tr >
						<th>Action</th>
						<th>Office</th>
						<th>Head of Office</th>
					</tr>
					</thead>
					<tbody>
					<?php if($employee): ?>
						<?php foreach($employee as $key => $values): ?>
							<tr>
								<td>
									<a class="btn btn-info btn-xs" href="<?php echo base_url("editOfficeHeadForm/".$values->id); ?>"> <i class="fa fa-edit"></i> Edit </a>
									 | 
									<a class="btn <?php if($values->status!=1){ echo "btn-primary";}else{ echo "btn-danger"; } ?>  btn-xs"  href="changeStatusOfficeHead?id=<?php echo $values->id; ?>&status=<?php echo $values->status; ?>">  <i class="fa fa-save"></i> <?php if($values->status!=1){ echo "Activate";}else{ echo "Deactivate"; } ?> </a>
								</td>
								<td><?php echo $values->description; ?></td>
								<td><?php echo $values->last_name; ?>, <?php echo $values->first_name; ?>&nbsp;<?php echo $values->middle_name; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan=3><div class='alert alert-info'><i class="fa fa-info"></i> No Office Heads Found!</div></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>

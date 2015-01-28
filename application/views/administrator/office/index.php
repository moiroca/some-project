
<div class="row">
	<div class="col-lg-12" style="margin-top:20px;">
    	<div class="panel panel-primary">
			<div class="panel panel-heading">
				<h1 class="panel-title"><i class="fa fa-building"></i> Offices</h1>
			</div>
			<div class="panel panel-body">
				<table class="table table-condensed table-hover table-striped table-bordered">
					<thead>
					<tr>
						<th>Action</th>
						<th>Name</th>
					</tr>
					</thead>
					<tbody>
					<?php if($offices): ?>
						<?php foreach($offices as $key => $values): ?>
							<tr>
								<td>
									<a  class="btn btn-info btn-xs"  onclick="editOffice(<?php echo $values->id; ?>,'<?php echo $values->description;?>')" href="#"> <i class="fa fa-edit"></i> Edit </a>
									|
									<a class="btn btn-danger btn-xs"  onclick="deleteConfirm(<?php echo $values->id; ?>)" href="#"> <i class="fa fa-trash"></i> Delete </a>
								</td>
								<td><?php echo $values->description; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</div>

    <link href=<?php echo base_url("public/css/file_upload.css"); ?> rel="stylesheet">
	<div class="row" style="padding-top:20px;">
    	
	</div>
	
	<div class="row" style="margin-bottom:10px;">
		<form method="GET" action="<?php echo base_url("administrator/searchFile"); ?>">
			<div class="col-lg-12">
				<div class="pull-right">
					<div class="form-group clearfix">
						<div class="control-group">
							<label style="font-size:20px; margin-top:10px; position:relative; top:5px;" >Search File</label>
							<input style="width:300px; height:35px;" type="text" name="searchFile" />	
						</div>
					</div>
				</div>
			</div>
		</form>
	</div><!-- /.row -->

	<div class="row" >
    	<div class="col-lg-12">
         
			<div class="panel panel-primary">
			  <div class="panel-heading clearfix">
				Folders	
			  </div>
			  <div class="panel-body">
				<table class="table table-condensed talbe-striped">
					<thead>
					</thead>
					<tbody>
						<tr>
							<th>File Name</th>
							<th> Folder Location </th>
							<th>File Description</th>
							<th> Type</th>
						</tr>
						<?php if(!empty($files)): ?>
							<?php foreach($files as $key => $values): ?>
								<tr>
									<td><?php echo $values->name; ?></td>
									<td><?php echo ($values->file_type != "0")?"<a href=".base_url('secretary/createFolder?folder_id='.$values->folder_id).">Open File Location</a>":"<a href=".base_url('secretary/createFolder?folder_id='.$values->id).">Open Folder</a>"; ?></td>
									<td><?php echo !empty(fileLibrary::getDescriptionById($values->id))?fileLibrary::getDescriptionById($values->id)[0]->file_description:""; ?></td>
									<td><?php echo ($values->file_type == "0")?"Folder":$values->file_type; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan=3> <div class="alert alert-danger">No File or Folder Found!</div></td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
			  </div>
			</div>
		</div>
	</div>
	
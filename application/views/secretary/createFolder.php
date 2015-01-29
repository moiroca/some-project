    <link href=<?php echo base_url("public/css/file_upload.css"); ?> rel="stylesheet">
	<div class="row" style="padding-top:20px;">
    	<div class="col-lg-12">
		
	<?php
		 	$breadCrumbsObject = new breadcrumbs;
			$breadCrumbsObject->showBreadCrumbs($breadCrumbs);
		?>
		</div>
	</div>
	
	<div class="row">
    	<div class="col-lg-12">
			<div class="panel panel-primary">
			  <div class="panel-heading clearfix">
				Folders	<a class="pull-right btn btn-danger btn-xs" onclick="saveFolder(<?php echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>);"><i class='fa fa-save'></i>  Add Folder</a>
			  </div>
			  <div class="panel-body">
				<?php if(!empty($folders)):?>
					<div id="folders">
						<?php foreach($folders as $key => $values): ?>
						<div class="pull-left folders" style="margin-left:20px;">
							<a title="<?php echo $values->name; ?>" href=<?php echo base_url("secretary/createFolder?folder_id=".$values->id);?>>
								<li class="fa fa-folder fa-4x"></li>
								<p title="<?php echo $values->name; ?>"><?php echo substr($values->name,0,10)."...";?></p>
							</a>
<<<<<<< HEAD
							<span onclick="return deleteFolder(<?php echo $values->id; ?>)" class="delete"><i class="fa fa-trash fa-2x"></i></span>
							<span onclick="return editFolder(<?php echo $values->id; ?>,$(this))" class="edit"><i class="fa fa-edit fa-2x"></i></span>
=======
							<span onclick="return deleteFolder(<?php echo $values->id; ?>,<?php echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>)" class="delete"><i class="fa fa-trash fa-2x"></i></span>
							
>>>>>>> 49b2599a0e1ce36f47076ce30fb6a9171af7d35b
						</div>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>
			  </div>
			</div>
		</div>
	</div>
	<div class="row">
    	<div class="col-lg-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">
			   Files 
			   <!-- <a class="pull-right btn btn-primary btn-xs" onclick="saveFile(<?php //echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>);"><i class='fa fa-save'></i>  Add File</a> -->
			  <button type="button" class="pull-right btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">
			  <i class='fa fa-file'></i>   Add File/s
				</button>
			  </div>
			  <div class="panel-body">
						<table class="table table-hover table-condensed table-striped table-bordered" >
					<thead>
					<tr >
						<th>Name</th>
						<th>Document</th>
					</tr>
					</thead>
					<tbody>
					<?php if($files): ?>
						<?php foreach($files as $key => $values): ?>
							<tr>
								<td><?php echo $values->last_name; ?>, <?php echo $values->first_name; ?>&nbsp;<?php echo $values->middle_name; ?></td>
								<td><a href="<?php echo base_url('fileDownload'); ?>?id=<?php echo $values->id; ?>"><?php echo $values->name; ?></a></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan=3><div class='alert alert-info'><i class="fa fa-info"></i> No Uploaded File!</div></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			  </div>
			</div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload File</h4>
      </div> -->
      <div class="modal-body">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="modal-title panel-heading" id="myModalLabel"><i class="fa fa-upload"></i> Upload File</h4>
			</div>
			<div class="panel-body" style="padding:50px;">
				<div id="maindiv">
				<div id="formdiv">
					<form enctype="multipart/form-data" action="<?php echo base_url('fileUpload'); ?>" method="post" class="fileUploadForm">
						<input type="hidden" name="folderId" value="<?php echo $this->input->get('folder_id'); ?>">
						<div class="form-group">
							<label class="control-label pull-left"> Employee </label>
							<?php if(!empty($users)): ?>
								<select class="form-control"  name="user_id" id="user_id">
									<option value="">----- Select Employee ------</option>
									<?php foreach($users as $key => $values): ?>
										<option value="<?php echo $values->id ?>" ><?php echo $values->last_name.", ".$values->first_name." ".$values->middle_name; ?></option>
									<?php endforeach; ?>
								</select>
							<?php else: ?>
								<div class="alert alert-info"> <i class="fa fa-info"></i> No Employee Found! </div>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<div id="filediv"><input class="form-control" name="file[]" type="file" id="file"/></div>
						</div>
						<div class="clearfix">
							<button type="button" id="add_more" class="btn btn-primary"><i class="fa fa-save"></i> Add More Files</button>
							<button type="submit" id="upload" class="btn btn-danger"/><i class="fa fa-upload"></i> Upload</button>
							<!-- <i class="fa fa-upload"></i><input type="submit" id="upload" class="btn btn-danger" value="Upload"/>  -->
						</div>
					</form>
				</div>
		</div>
			</div>
		</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div> -->
    </div>
  </div>
</div>
    <link href=<?php echo base_url("public/css/file_upload.css"); ?> rel="stylesheet">
	<div class="row" style="padding-top:20px;">
    	<div class="col-lg-12">
		
	<?php
		 	$breadCrumbsObject = new breadcrumbs;
			$breadCrumbsObject->showBreadCrumbs($breadCrumbs);
		?>
		</div>
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
				Folders	<a class="pull-right btn btn-danger btn-xs" onclick="saveFolder(<?php echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>);"><i class='fa fa-save'></i>  Add Folder</a>
				
			  </div>
			  <div class="panel-body">
				<?php if(!empty($folders)):?>
                        <img id="loader" width="50" height="50" style="position:absolute; left: 45%; top:45%; z-index:100;  " src="<?php echo base_url("public/img/loading.gif"); ?>" />					<div id="folders">
						<?php foreach($folders as $key => $values): ?>
						<div class="pull-left folders" style="margin-left:20px;">
							<a title="<?php echo $values->name; ?>" href=<?php echo base_url("secretary/createFolder?folder_id=".$values->id);?>>
								<li class="fa fa-folder fa-4x"></li>
								<p title="<?php echo $values->name; ?>"><?php echo substr($values->name,0,10)."...";?></p>
							</a>


							<span onclick="return deleteFolder(<?php echo $values->id; ?>,<?php echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>)" class="delete"><i class="fa fa-trash fa-2x"></i></span>
							<span onclick="return editFolder(<?php echo $values->id; ?>,$(this))" class="edit"><i class="fa fa-edit fa-2x"></i></span>

						</div>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>
			  </div>
			</div>
		</div>
	</div>
	<?php if($this->input->get('folder_id')): ?>
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
						<th>Title</th>
						<th>File Name</th>
						<th>Description / Other Info</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php if($files): ?>
						<?php foreach($files as $key => $values): ?>
							<tr>
								<td>
									<?php if($values->user_id != 0){ ?>
										<?php echo $values->last_name; ?>, 
										<?php echo $values->first_name; ?>&nbsp;
										<?php echo $values->middle_name; ?>
									<?php } else {
										echo "General File";
									}?>
								</td>
								<td><?php echo $values->file_title; ?></td>
								<td><?php echo $values->name; ?></td>
								<td><?php 
									echo $values->file_description;
									 if( (!empty($values->file_description)) && (!empty($values->other_info))){ 
									 	echo " / "; 
									 }
									 echo $values->other_info; ?>
								</td>
								<td><a class="btn btn-danger btn-xs" href="<?php echo base_url('fileDownload'); ?>?name=<?php echo $values->name_in_folder; ?>&original_name=<?php echo $values->name; ?>">Download</a>
									 | 
									<a class="btn btn-danger btn-xs" onclick="deleteFile('<?php echo $values->id; ?>', '<?php echo $values->name_in_folder; ?>', '<?php echo $this->input->get('folder_id'); ?>')">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan=5><div class='alert alert-info'><i class="fa fa-info"></i> No Uploaded File!</div></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			  </div>
			</div>
        </div>
    </div>
<?php endif; ?>
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
						
						<div class="form-group well">
									<input type="radio"  name="fileFolder" id="ind-folder"  value="1" checked> Individual Folder
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio"  name="fileFolder" value="0" id="gen-folder"> General Folder
						</div>
						<div class="form-group ind-folder-div well">
							<label class="control-label pull-left"> Employee </label>
							<hr>
							<div style="margin-bottom: 70px;"class="input-prepend" name="searchKey">
				                	<select class="col-sm-4" id="searchKey">
				                		<option value="0">Search by</option>
				                		<option value="1">ID</option>
				                		<option value="2">Lastname</option>
				                	</select>
				              		<input class="col-sm-8" onKeyUp="search(this.value)" id="appendedPrependedDropdownButton" type="text" name="searchMe" placeholder="Search">
				              </div>
							<?php if(!empty($users)): ?>
								<select class="form-control"  name="user_id" id="user_id">
									<option value="">----- Select Employee ------</option>
									<?php foreach($users as $key => $values): ?>
										<option value="<?php echo $values->id ?>" id="names"><?php echo $values->last_name.", ".$values->first_name." ".$values->middle_name; ?></option>
									<?php endforeach; ?>
								</select>
							<?php else: ?>
								<div class="alert alert-info"> <i class="fa fa-info"></i> No Employee Found! </div>
							<?php endif; ?>
						</div>

						<div id="filediv" class="form-group well">
								<!-- <i class="fa fa-times pull-right"></i> -->
								<img src="<?php echo base_url('public/img/x.png') ?>" id="img" class="xxx">
								<input class="form-control" name="file[]" type="file" id="file"/>
								<input class="form-control" placeholder="Title" name="fileTitle[]" type="text" id="fileTitle"/>
								<input class="form-control" placeholder="Description" name="fileDescription[]" type="text" id="fileDescription"/>
								<input class="form-control" placeholder="Other Information" name="fileOtherInfo[]" type="text" id="fileOtherInfo"/>
						
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


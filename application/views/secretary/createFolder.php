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
			<div class="panel panel-info">
			  <div class="panel-heading clearfix">
				Folders	<a class="pull-right btn btn-primary btn-xs" onclick="saveFolder(<?php echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>);"><i class='fa fa-save'></i>  Add Folder</a>
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
							<span onclick="return deleteFolder(<?php echo $values->id; ?>)" class="delete"><i class="fa fa-trash fa-2x"></i></span>
							
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
			<div class="panel panel-info">
			  <div class="panel-heading">
			   Files 
			   <!-- <a class="pull-right btn btn-primary btn-xs" onclick="saveFile(<?php //echo ($this->input->Get("folder_id")?$this->input->Get("folder_id"):0);?>);"><i class='fa fa-save'></i>  Add File</a> -->
			  <button type="button" class="pull-right btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
			  Add File/s
				</button>
			  </div>
			  <div class="panel-body">
			  <?php if(!empty($files)): ?>
					<ul>
					<?php foreach($files as $key => $values): ?>
						<li><?php echo $values->last_name.", ".$values->first_name." ".$values->last_name."-".$values->name; ?></li>
					<?php endforeach; ?>
					</ul>
				<?php else: ?>
				<?php endif; ?>
			  </div>
			</div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload File</h4>
      </div>
      <div class="modal-body">
       <div id="maindiv">
		<div id="formdiv">
			<form enctype="multipart/form-data" action="<?php echo base_url('fileUpload'); ?>" method="post" class="fileUploadForm">
				<input type="hidden" name="folderId" value="<?php echo $this->input->get('folder_id'); ?>">
				<?php if(!empty($users)): ?>
					<select name="user_id">
						<option value="">----- Select Employee ------</option>
						<?php foreach($users as $key => $values): ?>
							<option value="<?php echo $values->id ?>" ><?php echo $values->last_name.", ".$values->first_name." ".$values->middle_name; ?></option>
						<?php endforeach; ?>
					</select>
				<?php else: ?>
				<?php endif; ?>
				<center><div id="filediv"><input name="file[]" type="file" id="file"/></div></center>
				<input type="button" id="add_more" class="upload" value="Add More Files"/>
				<input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
			</form>
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->	
      </div>
    </div>
  </div>
</div>
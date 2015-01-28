
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Multiple Image Upload Form</h4>
      </div>
      <div class="modal-body">
       <div id="maindiv">
		<div id="formdiv">
		<form enctype="multipart/form-data" action="<?php echo base_url('fileUpload'); ?>" method="post" class="fileUploadForm">
		<h3>Upload File/s</h3>
		<center><div id="filediv"><input name="file[]" type="file" id="file"/></div></center>
		<input type="button" id="add_more" class="upload" value="Add More Files"/>
		<input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
		</form>
		<!------- Including PHP Script here ------>
		<?php //include "upload.php"; ?>
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
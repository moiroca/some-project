
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
					<div class="folders">
						<?php foreach($folders as $key => $values): ?>
						<div class="pull-left" style="margin-left:20px;">
							<a title="<?php echo $values->name; ?>" href=<?php echo base_url("secretary/createFolder?folder_id=".$values->id);?>>
								<li class="fa fa-folder fa-4x"></li>
								<p><?php echo $values->name;?></p>
							</a>
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
			  </div>
			  <div class="panel-body">
			  <?php if(!empty($files)): ?>
					<ul>
					<?php foreach($files as $key => $values): ?>
						<li><?php echo $values->name." - ".$values->file_type." "; ?></li>
					<?php endforeach; ?>
					</ul>
				<?php else: ?>
				<?php endif; ?>
			  </div>
			</div>
        </div>
    </div>
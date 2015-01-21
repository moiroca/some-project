<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Office Heads</h1>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
    	<table class="table">
            <thead>
            <tr>
                <th>Action</th>
                <th>Office</th>
                <th>Head of Office</th>
            </tr>
            </thead>
            <tbody>
            <?php if($officeHeads): ?>
            	<?php foreach($officeHeads as $key => $values): ?>
                	<tr>
                        <td>
                        	<a href="editOfficeHeadForm?id=<?php echo $values->id; ?>&description=<?php echo $values->description;?>&officeId=<?php echo $values->officeId;?>&lastname=<?php echo $values->lastname;?>&firstname=<?php echo $values->firstname;?>&middlename=<?php echo $values->middlename;?>&lnu_id=<?php echo $values->username;?>&status=<?php echo $values->status;?>"> Edit </a>
                            <a href="changeStatusOfficeHead?id=<?php echo $values->id; ?>&status=<?php echo $values->status; ?>"> <?php if($values->status!=1){ echo "Activate";}else{ echo "Deactivate"; } ?> </a>
                        </td>
                        <td><?php echo $values->description; ?></td>
                        <td><?php echo $values->lastname; ?>, <?php echo $values->firstname; ?>&nbsp;<?php echo $values->middlename; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
    	<table class="table">
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
                        	<a href="#"> Edit </a>
                            <a onclick="deleteConfirm(<?php echo $values->id; ?>)" href="#"> Delete </a>
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

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">New Office Head</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-4">
    <form method="POST" action="addOfficeHead">
      <table class="table">
            <thead>
            <tr>
                <th><strong><?php echo validation_errors(); ?></strong></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php if($offices): ?>
                            <select name="office_id">
                                <option value="">-------Select Office-------</option>
                                <?php foreach($offices as $key => $values): ?>
                                    <option value="<?php echo $values->id; ?>">
                                        <?php echo $values->description; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" name="lastname" placeholder="Lastname" value="<?php echo set_value('lastname'); ?>" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="firstname" placeholder="Firstname"  value="<?php echo set_value('firstname'); ?>" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="middlename" placeholder="Middlename"  value="<?php echo set_value('middlename'); ?>" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="lnu_id" placeholder="LNU ID"  value="<?php echo set_value('lnu_id'); ?>" required></td>
                </tr>
                <tr>
                    <td>
                        <select name="status">
                            <option  value="">-------Select Status-------</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="ADD" ></td>
                </tr>
            </tbody>
        </table>
    </form>
   </div>
</div>

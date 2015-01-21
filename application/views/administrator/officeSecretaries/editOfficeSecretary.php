<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-4">
    <form method="POST" action="editOfficeSecretary">
        <input type="hidden" name="officeHeadId" value="<?php echo $this->input->get('id')?>">

      <table class="table">
            <thead>
            <tr>
                <th><strong>Edit Secretary</strong></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php if($offices): ?>
                            <select name="office_id">
                                <option value="">-------Select Office-------</option>
                                <?php foreach($offices as $key => $values): ?>
                                    <?php if ($this->input->get('officeId')==$values->id){ ?>
                                        <option value="<?php echo $values->id; ?>" selected>
                                            <?php echo $values->description; ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?php echo $values->id; ?>">
                                            <?php echo $values->description; ?>
                                        </option>
                                    <?php }?>
                                    
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" name="lastname" placeholder="Lastname" value="<?php echo $this->input->get('lastname')?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="firstname" placeholder="Firstname" value="<?php echo $this->input->get('firstname')?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="middlename" placeholder="Middlename" value="<?php echo $this->input->get('middlename')?>"></td>
                </tr>
                <tr>
                    <td><input type="text" name="lnu_id" placeholder="LNU ID" value="<?php echo $this->input->get('lnu_id')?>"></td>
                </tr>
                <tr>
                    <td>
                        <select name="status">
                            <option value="">-------Select Status-------</option>
                            <?php if ($this->input->get('status')==1){ ?>
                                <option value="1" selected>Active</option>
                                 <option value="0">Inactive</option>
                            <?php } else { ?>
                                <option value="1">Active</option>
                                 <option value="0" selected>Inactive</option>
                            <?php }?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="SAVE" ></td>
                </tr>
            </tbody>
        </table>
    </form>
   </div>
</div>

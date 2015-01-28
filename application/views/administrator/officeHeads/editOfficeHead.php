<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-10">
     <!-- new form  -->

    <div class="testbox">
      <form method="POST" action="editOfficeHead">
        <input type="hidden" name="usersId" value="<?php echo $this->input->get('id')?>">
        <div class="accounttype">
          <!-- <strong style="color:red"><?php //echo validation_errors(); ?></strong> -->
        </div>
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
      <input type="text" id="name" name="lastname" placeholder="Lastname" value="<?php echo $this->input->get('lastname')?>" required/>
      
      <input type="text" id="name" name="firstname" placeholder="Firstname" value="<?php echo $this->input->get('firstname')?>" required/>
      
      <input type="text" id="name" name="middlename" placeholder="Middlename" value="<?php echo $this->input->get('middlename')?>" required/>
      
      <input type="text" id="name" name="lnu_id" placeholder="LNU ID" value="<?php echo $this->input->get('lnu_id')?>" required/>
        
      <div class="gender">
        <?php if ($this->input->get('status')==1){ ?>
                <input type="radio" value="1" id="male" name="status" checked/>
                <label for="male" class="radio" chec>Active</label>
                <input type="radio" value="0" id="female" name="status" />
                <label for="female" class="radio">Inactive</label>
            <?php } else { ?>
                <input type="radio" value="1" id="male" name="status" />
                <label for="male" class="radio" chec>Active</label>
                <input type="radio" value="0" id="female" name="status" checked/>
                <label for="female" class="radio">Inactive</label>
            <?php }?>
       </div> 
            
        <center>
          <input type="submit" value="SAVE" class="btn btn-primary">
        </center>
      </form>
    </div>
    <!-- end of new form -->
    
   </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">New Office Head</h1>
    </div>
</div>

<div class="row">
  <div class="col-lg-10">

    <!-- new form  -->

    <div class="testbox">
      <form method="POST" action="addOfficeHead">
        <div class="accounttype">
          <strong style="color:red"><?php echo validation_errors(); ?></strong>
        </div>
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
      <input type="text" id="name" name="lastname" placeholder="Lastname" value="<?php echo set_value('lastname'); ?>" required/>
      
      <input type="text" id="name" name="firstname" placeholder="Firstname"  value="<?php echo set_value('firstname'); ?>" required/>
      
      <input type="text" id="name" name="middlename" placeholder="Middlename"  value="<?php echo set_value('middlename'); ?>" required/>
      
      <input type="text" id="name" name="lnu_id" placeholder="LNU ID"  value="<?php echo set_value('lnu_id'); ?>" required/>
        
      <div class="gender">
        <input type="radio" value="1" id="male" name="status" checked/>
        <label for="male" class="radio" chec>Active</label>
        <input type="radio" value="0" id="female" name="status" />
        <label for="female" class="radio">Inactive</label>
       </div> 
        <center>
          <input type="submit" value="Register" class="btn btn-primary">
        </center>
      </form>
    </div>
    <!-- end of new form -->
   </div>
</div>



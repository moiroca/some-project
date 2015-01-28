<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">New Office</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-4">

    <!-- new form  -->

    <div class="testbox">
      <form method="POST" action="addOffice">
        <div class="accounttype">
          <strong style="color:red"><?php echo validation_errors(); ?></strong>
        </div>
        
      <input type="text" id="name" name="description" placeholder="Name of Office" value="<?php echo set_value('description'); ?>" required/>
        
      <div class="gender">
        
       </div> 
        <center>
          <input type="submit" value="ADD" class="btn btn-primary">
        </center>
      </form>
    </div>
    <!-- end of new form -->
    
   </div>
</div>

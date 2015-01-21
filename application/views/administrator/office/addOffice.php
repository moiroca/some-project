<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">New Office</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-4">
    <form method="POST" action="addOffice">
      <table class="table">
            <thead>
            <tr>
                <th><strong><?php echo validation_errors(); ?></strong></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="description" placeholder="Name of Office" value="<?php echo set_value('description'); ?>" required> <input type="submit" value="ADD" ></td>
                </tr>
            </tbody>
        </table>
    </form>
   </div>
</div>

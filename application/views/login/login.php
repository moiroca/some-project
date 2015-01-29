<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href=<?php echo base_url("public/css/bootstrap.min.css"); ?>  rel="stylesheet">

    <!-- Custom CSS -->
    <link href=<?php echo base_url("public/css/sb-admin-2.css"); ?> rel="stylesheet">

    <!-- Custom Fonts -->
    <link href=<?php echo base_url("public/css/font-awesome.min.css"); ?>  rel="stylesheet" type="text/css">
	<style type="text/css">
		.container{
			margin:100px auto;
		}
		.panel{
			margin:auto;
			margin-left:auto;
		}
	</style>
</head>

<body>

    <div class="container">
        <div class="row">
			  <div class="col-lg-2">
			</div>
            <div class="col-lg-8">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
						 <div class="col-lg-4">
							<img style="width:200px; height:200px;" src="<?php echo base_url('public/img/loupe-pc-bd.jpg'); ?>" />
						</div>
						 <div class="col-lg-8">
							 <form role="form" method="post" action="<?php echo base_url("login/userLogin"); ?>">
								<fieldset>
									<div class="form-group">
										<?php echo ($this->input->get("retryLogin") == "true")?"<div class='alert alert-success'><i class='fa fa-check'></i> Login With Your New Credentials!</div>":""; ?>
										<?php echo validation_errors(); ?>
										<?php if(isset($usernotfound)):?>
											<div class="alert alert-danger"><i class="fa fa-warning"></i> User Not Found!</div>
										<?php endif; ?>
									</div>
									<div class="form-group">
											<input class="form-control" placeholder="Username" name="username" type="text" autofocus />
									</div>
									<div class="form-group">
											<input class="form-control" placeholder="Password" name="password" type="password">
									</div>
									<!-- Change this to a button or input when using this as a form -->
									<button type="submit" class="btn btn-mini btn-success btn-block"><i class="fa fa-unlock"></i> Login</button>
								</fieldset>
							</form>
						</div>
                    </div>
                </div>
            </div>
			<div class="col-lg-2">
			</div>
        </div>
    </div>

    <!-- jQuery -->
    <script src=<?php echo base_url("public/js/jquery.min.js"); ?>></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=<?php echo base_url("public/js/bootstrap.min.js"); ?>></script>

    <!-- Custom Theme JavaScript -->
    <script src=<?php echo base_url("public/js/sb-admin-2.js"); ?>></script>

</body>

</html>

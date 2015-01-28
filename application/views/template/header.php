<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Archiving</title>
   <!-- Bootstrap Core CSS -->
    <link href=<?php echo base_url("public/css/bootstrap.min.css"); ?> rel="stylesheet">
    <!-- Custom CSS -->
    <link href=<?php echo base_url("public/css/sb-admin-2.css"); ?> rel="stylesheet">
    <link href=<?php echo base_url("public/css/file_upload.css"); ?> rel="stylesheet">
    <!-- Custom Fonts -->
    <link href=<?php echo base_url("public/css/font-awesome.min.css"); ?> rel="stylesheet" type="text/css">
	<?php customLoader::css(isset($css)?$css:array()); ?>
</head>

<body>
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><i class="fa fa-file-archive-o fa-1x"></i> LNU Archiving</a>
            </div>
            <!-- /.navbar-header -->
			
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href=<?php echo base_url("logout"); ?>><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<?php if(loginLibrary::isLoggedInAdministrator()): ?>
						<li >
                            <a href="#"><i class="fa fa-bar-chart-o fa-users"></i> User Management </a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=<?php echo base_url("officeHead"); ?>><i class="fa fa-user"></i> Office Head Management</a>
									 <ul class="nav nav-third-level">
										 <li>
											<a href=<?php echo base_url("addOfficeHeadForm"); ?>>Add Office Head</a>
										 </li>
									 </ul>
                                </li>
								<li>
                                    <a href=<?php echo base_url("officeSecretary"); ?>><i class="fa fa-user"></i> Secretary Management</a>
									<ul class="nav nav-third-level">
										 <li>
											<a href="<?php echo base_url("addOfficeSecretaryForm"); ?>"><i class="fa fa-user-times"></i> Add Secretary</a>
										 </li>
									 </ul>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li >
                            <a href="<?php echo base_url('office'); ?>"><i class="fa fa-building"></i> Office Management</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href=<?php echo base_url("addOfficeForm"); ?>>Add Office</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php endif; ?>
                        <?php if (loginLibrary::isLoggedInOfficeHead()): ?>
                            <li>
                                <a href=<?php echo base_url("officeSecretary"); ?>>Office Secretary Management</a>
                                <ul class="nav nav-second-level">
                                     <li>
                                        <a href=<?php echo base_url("addOfficeSecretaryForm"); ?>>Add Secretary</a>
                                     </li>
                                 </ul>
                            </li>
                        <?php endif ?>
						<li >
                            <a href="<?php echo base_url('createFolder'); ?>"><i class="fa fa-file"></i> File Management</a>
                            <!-- /.nav-second-level -->
                        </li>
                     </ul>  
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
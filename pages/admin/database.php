<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>library Management System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../web/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../web/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../web/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../web/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
require("../../service/adminValidator.php");
?>

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
            <a class="navbar-brand" href="dashboard.php">Library Management System</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> Admin Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i>Book Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="returnBook.php">Return Book</a>
                            </li>
                            <li>
                                <a href="updateBook.php">Update Book</a>
                            </li>
                            <li>
                                <a href="addBook.php">Add Book</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> User Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="updateUser.php">Update User</a>
                            </li>
                            <li>
                                <a href="addAdmin.php">Add Admin</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> DataBase Management</a>
                        <!-- /.nav-second-level -->
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <a name="about"></a>
        <div class="intro-header" style="height: 100%">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-md-offset2">
                        <div class="login-panel panel panel-default intro-message" style="padding-top: 0;padding-bottom: 0">
                            <div class="panel-heading">
                                <h3 class="panel-title">Table Backup</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" action="../../service/backup.php" method="get">
                                    <fieldset>
                                        <div class="form-group" >
                                            <label >Choose table that need backup</label>
                                            <select class="form-control" name="table">
                                                <option>user</option>
                                                <option>admin</option>
                                                <option>book</option>
                                                <option>borrowRecord</option>
                                                <option>category</option>
                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label >Backup Date</label>
                                            <label class="form-control"><?php echo date("Y-m-d")?></label>
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <button type="submit" class="btn btn-lg btn-primary btn-block" >Backup</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset1">
                        <div class="login-panel panel panel-default intro-message" style="padding-top: 0;padding-bottom: 0">
                            <div class="panel-heading">
                                <h3 class="panel-title">Table Recover</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" action="../../service/recover.php" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="form-group" >
                                            <label >Choose table that need recover</label>
                                            <select class="form-control">
                                                <option>user</option>
                                                <option>admin</option>
                                                <option>book</option>
                                                <option>borrowRecord</option>
                                                <option>category</option>
                                            </select>
                                        </div>
                                        <div class="form-group" >
                                            <label >Upload SQL file</label>
                                            <input type="file"  class="form-control"  name="file" id="file" required="required">
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <button id="submit" type="submit" class="btn btn-lg btn-success btn-block" >Recover</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../../web/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../web/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../web/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../../web/vendor/raphael/raphael.min.js"></script>
<script src="../../web/vendor/morrisjs/morris.min.js"></script>
<script src="../../web/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../web/dist/js/sb-admin-2.js"></script>


</body>

</html>
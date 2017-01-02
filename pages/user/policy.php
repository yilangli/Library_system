<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LBS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../web/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../web/dist/css/sb-admin-2.css" rel="stylesheet">

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
            require("../../service/userValidator.php");
            $username=$_SESSION["username"];
            require ("../../dao/RecordDao.php");
            $dao=new RecordDao();
            //borrowed record with user name
            $returns=$dao->queryByUser($username," order by return_date asc limit 0, 5");


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
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php

                        $arrlength=count($returns);
                        for($x=0;$x<$arrlength;$x++){
                            $return=$returns[$x];
                            echo '<li>
                        <a href="#">
                            <div>
                                <strong>'.$return->getBook()->getTitle().'</strong>
                                <span class="pull-right text-muted">
                                        <em>'.$return->getReturnDate().'</em>
                                    </span>
                            </div>
                            <div>The due of this book is '.$return->getReturnDate().'. Please return as soon as possible.</div>
                        </a>
                    </li>
                    <li class="divider"></li>';
                        }
                        ?>


                        <li>
                            <a class="text-center" href="br.php">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i><?php echo $_SESSION["username"]?> 's profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../service/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>                    </li>
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
                            <a href="br.php"><i class="fa fa-dashboard fa-fw"></i> Borrow & Return</a>
                        </li>
                        <li>
                            <a href="search.php"><i class="fa fa-table fa-fw"></i> Book Search</a>
                        </li>
                        <li>
                            <a href="policy.php"><i class="fa fa-edit fa-fw"></i> Library Policy</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Policy</h1>
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <ul style="font-size: large">
                                    <li>
                                        Borrowers are responsible for library materials charged out to them until they are returned to the lending library.
                                    </li>
                                    <li>
                                        Borrowers are responsible for library materials charged out to them until they are returned to the lending library.
                                    </li>
                                    <li>
                                        Borrowers are responsible for library materials charged out to them until they are returned to the lending library.
                                    </li>
                                    <li>
                                        Borrowers are responsible for library materials charged out to them until they are returned to the lending library.
                                    </li>
                                    <li>
                                        Borrowers are responsible for library materials charged out to them until they are returned to the lending library.
                                    </li>
                                    <li>
                                        Borrowers are responsible for library materials charged out to them until they are returned to the lending library.
                                    </li>
                                </ul>
                            </div>
                            </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../../web/dist/js/sb-admin-2.js"></script>

</body>

</html>

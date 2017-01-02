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
    include_once("../../service/adminValidator.php");
    include_once ("../../dao/RecordDao.php");
    $username=$_SESSION["username"];
    $dao=new RecordDao();
    //the book that borrowed most
    $mosts=$dao->queryByCondition("order by number desc limit 0,6");
    //the book that borrowed recently
    $recents=$dao->queryByCondition("order by borrow_date desc limit 0,6");
    //borrow record with user name
    $borrow=count($dao->queryByquery("SELECT * FROM borrowRecord WHERE borrow_date = CURDATE( ) "));
    //return records with user name
    $return=count($dao->queryByquery("SELECT * FROM borrowRecord WHERE return_date = CURDATE( ) "));
    $userDao=new UserDao();
    $registered=count($userDao->queryAll());
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
                        <li><a href="../../service/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="database.php"><i class="fa fa-files-o fa-fw"></i> DataBase Management</a>
                            <!-- /.nav-second-level -->
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart fa-fw"></i> Most Borrowed
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>Tile</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Year</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $arrlength=count($mosts);
                                    for($x=0;$x<$arrlength;$x++){
                                        $most=$mosts[$x];
                                        echo '<tr>
                                        <td>'.$most->getISBN().'</td>
                                        <td>'.$most->getBook()->getTitle().'</td>
                                        <td>'.$most->getBook()->getAuthor().'</td>
                                        <td>'.$most->getBook()->getPublisher().'</td>
                                        <td>'.$most->getBook()->getYearOfPublish().'</td>
                                        </tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Most Recently Borrowed
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th>ISBN</th>
                                                <th>Tile</th>
                                                <th>Author</th>
                                                <th>Publisher</th>
                                                <th>Year</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $arrlength=count($recents);
                                            for($x=0;$x<$arrlength;$x++){
                                                $recent=$recents[$x];
                                                echo '<tr>
                                        <td>'.$recent->getISBN().'</td>
                                        <td>'.$recent->getBook()->getTitle().'</td>
                                        <td>'.$recent->getBook()->getAuthor().'</td>
                                        <td>'.$recent->getBook()->getPublisher().'</td>
                                        <td>'.$recent->getBook()->getYearOfPublish().'</td>
                                        </tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>

                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Today's record
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="col-lg-12 " style="padding-top: 1%">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-book fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $borrow?></div>
                                                <div>Borrow</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12 " style="padding-top: 1%">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-book fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $return?></div>
                                                <div>Return</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 " style="padding-top: 1%">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $registered?></div>
                                                <div>Registered</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
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

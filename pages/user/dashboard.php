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
    include_once("../../service/userValidator.php");
    include_once ("../../dao/RecordDao.php");
    include_once ("../../dao/BookDao.php");
    $username=$_SESSION["username"];
    $dao=new RecordDao();
    //return records with user name
    $returns=$dao->queryByUser($username," order by return_date asc limit 0, 5");
    //borrow record with user name
    $borrows=$dao->queryByUser($username," order by borrow_date desc limit 0, 5");
    //the book that borrowed most
    $mosts=$dao->queryByCondition("order by number desc limit 0,6");
    //the book that borrowed recently
    $recents=$dao->queryByCondition("order by borrow_date desc limit 0,6");
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
                                <a href="br.php"><i class="fa fa-tasks fa-fw"></i> Borrow & Return</a>
                            </li>
                            <li>
                                <a href="search.php"><i class="fa fa-search fa-fw"></i> Book Search</a>
                            </li>
                            <li>
                                <a href="policy.php"><i class="fa fa-question-circle fa-fw"></i> Library Policy</a>
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
                                            <th></th>
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
                                         <td><a href="bookDetail.php?ISBN='.$most->getISBN().'"><button class="btn btn-outline btn-block btn-primary btn-sm">view</button></a></td>
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
                        <div class="panel panel-default">
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
                                                    <th></th>
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
                                         <td><button class="btn btn-outline btn-block btn-primary btn-sm"><a href="bookDetail.php?ISBN='.$most->getISBN().'">view</a></button></td>
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
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i> Book Need Return
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Title</th>
                                            <th>Due</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $arrlength=count($returns);
                                        for($x=0;$x<$arrlength;$x++){
                                            $return=$returns[$x];
                                            echo '<tr>
                                        <td>'.$return->getISBN().'</td>
                                        <td>'.$return->getBook()->getTitle().'</td>
                                        <td>'.$return->getReturnDate().'</td>
                                        </tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.list-group -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <i class="fa fa-book fa-fw"></i>Borrowed Book
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Title</th>
                                            <th>Date</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $arrlength=count($borrows);
                                        for($x=0;$x<$arrlength;$x++){
                                            $borrow=$borrows[$x];
                                            echo '<tr>
                                        <td>'.$borrow->getISBN().'</td>
                                        <td>'.$borrow->getBook()->getTitle().'</td>
                                        <td>'.$borrow->getBorrowDate().'</td>
                                        </tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.list-group -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
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


        <!-- Custom Theme JavaScript -->
        <script src="../../web/dist/js/sb-admin-2.js"></script>



?>

</body>

</html>

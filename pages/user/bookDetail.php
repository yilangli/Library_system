<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

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
        require("../../service/userValidator.php");
        require ("../../dao/RecordDao.php");
        $username=$_SESSION["username"];
        $result;
        $isBorrowed;
        $borrowed;
        $isLimit;
            if(isset($_GET["action"])&&$_GET["ISBN"]){
                $userDao=new UserDao();
                $user=$userDao->queryById($username);
                if($user->getLimits()!=0){
                    $bookDao=new BookDao();
                    $book=$bookDao->queryById($_GET["ISBN"]);
                    $user->setLimits($user->getLimits()-1);
                    echo $user->getLimits();
                    echo $book->getQuantity();
                    $book->setQuantity($book->getQuantity()-1);

                    $userDao=new UserDao();
                    $bookDao=new BookDao();
                    $userDao->update($user);
                    $bookDao->update($book);
                    $record=new BorrowRecord();
                    $record->setUserName($username);
                    $record->setISBN($_GET["ISBN"]);
                    $recordDao=new RecordDao();
                    $recordDao->save($record);
                }else{
                    alert("You book borrow limit only 5!");
                }
            }

        if(isset($_GET["ISBN"])){
            $ISBN=$_GET["ISBN"];
            $dao= new BookDao();
            $result=$dao->queryById($ISBN);
            $recordDao=new RecordDao();
            $isBorrowed=count($recordDao->queryByquery("select * from borrowRecord where userName='$username' and ISBN='$ISBN' and status=1"));
            $recordDao=new RecordDao();
            $borrowed=count($recordDao->queryByquery("select * from borrowRecord where ISBN='$ISBN'"));
            $userDao=new UserDao();
            $user=$userDao->queryById($username);
            $isLimit=$user->getLimits();
        }
        $dao=new RecordDao();
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
            <div class="col-lg-10">
                <h1 class="page-header"><?php echo $result->getTitle()?></h1>
            </div>

            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">

                <!-- /.panel -->
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img style="width: 100%" src="<?php echo $result->getImage()?>">
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col-lg-4 (nested) -->
                            <div class="col-lg-7">
                                <div class="well">
                                <ul style="font-size: large">
                                    <li>
                                        ISBN: <?php echo $result->getISBN()?>
                                    </li>
                                    <li>
                                        Title: <?php echo $result->getTitle()?>
                                    </li>
                                    <li>
                                        Author: <?php echo $result->getAuthor()?>
                                    </li>
                                    <li>
                                        Category: <?php echo $result->getCategory()?>
                                    </li>
                                    <li>
                                        Publish year: <?php echo $result->getYearOfPublish()?>
                                    </li>
                                    <li>
                                        Publisher: <?php echo $result->getPublisher()?>
                                    </li>
                                    <li>
                                        Location: <?php echo $result->getLocation() ?>
                                    </li>
                                    <li>
                                        Description: <?php echo $result->getDescription()?>
                                    </li>
                                </ul>
                                    </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="col-lg-12 " style="padding-top: 1%">
                                    <div class="panel panel-green">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-book fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div class="huge"><?php echo $result->getQuantity()?></div>
                                                    <div>Storage</div>
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
                                                    <div class="huge"><?php echo $borrowed ?></div>
                                                    <div>Borrowed</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline btn-block btn-primary btn-lg" data-toggle="modal" data-target="#myModal" >
                                   Borrow Book
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php  if($isBorrowed!=0)
                                                            echo "Already borrowed";
                                                        else if($result->getQuantity()==0)
                                                            echo "No storage!";
                                                         else if($isLimit==0)
                                                             echo "You book borrow limit is only 5.";
                                                         else
                                                             echo "Confirm to borrow this book?";
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="borrow()" <?php  if(($isBorrowed!=0)||$result->getQuantity()==0||$isLimit==0) echo "disabled";?>>Confirm</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </div>
                            <!-- /.col-lg-8 (nested) -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->

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

<script>
    function borrow() {
        $.get("bookDetail.php",{"action":"borrow","ISBN":<?php echo '"'.$ISBN.'"'?>},function () {
           location.reload(true);
        });
        
    }
</script>

</body>

</html>

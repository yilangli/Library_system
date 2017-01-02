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

    <!-- DataTables CSS -->
    <link href="../../web/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../web/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

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
            //a list of book borrowed record
            $returns=$dao->queryByUser($username," order by return_date asc ");
            //a list of book borrowed record
            $borrows=$dao->queryByUser($username," order by borrow_date desc ");
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
                <h1 class="page-header">Borrow & Return</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        Borrowed Results
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
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
                                             <td>'.$borrow->getBook()->getAuthor().'</td>
                                            <td>'.$borrow->getBorrowDate().'</td>
                                            </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                        <!--    <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div>-->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        Return Results
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
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
                                        <td>'.$return->getBook()->getAuthor().'</td>
                                        <td>'.$return->getReturnDate().'</td>
                                        </tr>';
                            }
                            ?>

                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                        <!--    <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div>-->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../../web/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../../web/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../web/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../../web/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../../web/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="../../web/vendor/datatables-responsive/dataTables.responsive.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../web/dist/js/sb-admin-2.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example1').DataTable({
                    responsive: true
                });
                $('#dataTables-example2').DataTable({
                    responsive: true
                });
            });
        </script>

</body>

</html>
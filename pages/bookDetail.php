<?php
    require ('../dao/BookDao.php');
    require ('../dao/RecordDao.php');
    $ISBN=$_GET["ISBN"];
    $bookDao= new BookDao();
    $book=$bookDao->queryById($ISBN);
    $recordDao=new RecordDao();
    $borrowed =count($recordDao->queryByBook($ISBN));


?>

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
    <link href="../web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../web/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../web/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../web/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../web/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../web/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
            <a class="navbar-brand" href="../index.php">Library Management System</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">


            <li><a href="login.php"><i class="fa fa-user fa-fw"></i> Login</a>
            </li>
            <li><a href="signup.php"><i class="fa fa-sign-out fa-fw"></i> Sign Up</a>
            </li>

            <!-- /.dropdown-user -->

            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="../index.php"><i class="fa fa-search fa-fw"></i> Book Search</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>

    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="page-header"><?php echo $book->getTitle(); ?></h1>
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
                                <img style="width: 100%" src="<?php echo $book->getImage();?>">
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col-lg-4 (nested) -->
                            <div class="col-lg-7">
                                <div class="well">
                                    <ul style="font-size: large">
                                        <li>
                                            ISBN: <?php  echo $book->getISBN(); ?>
                                        </li>
                                        <li>Title: <?php echo $book->getTitle(); ?>
                                        </li>
                                        <li>
                                            Author: <?php echo $book->getAuthor(); ?>
                                        </li>
                                        <li>
                                            Category: <?php echo $book->getCategory(); ?>
                                        </li>
                                        <li>
                                            Publish Year: <?php echo $book->getYearOfPublish(); ?>
                                        </li>
                                        <li>
                                            Publisher: <?php echo $book->getPublisher(); ?>
                                        </li>
                                        <li>
                                            Location: <?php echo $book->getLocation(); ?>
                                        </li>
                                        <li>
                                            Description: <?php echo $book->getDescription(); ?>
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
                                                    <div class="huge"><?php echo $book->getQuantity(); ?></div>
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
</div>
</body>

</html>
<?php

    //search book with book name or author name
    require ("../dao/BookDao.php");
    if(isset($_GET["type"])){
    $type=$_GET["type"];
    $name=$_GET["name"];
    $dao= new BookDao();
    //a list of book object
    $result;
    if ($type=="Name"){
        $result=$dao->queryByName($name);
    }else if($type=="Author") {
        $result = $dao->queryByAuthor($name);
    }
}
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

    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Book Search</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default" style="padding-top: 10px;padding-bottom: 40px">
                    <div class="panel-body">

                            <div class="form-group input-group" style="opacity: 0.7;width: 70%; margin-left: auto;margin-right: auto;">
                                <div class="input-group-btn dropdown">
                                    <button id="searchType" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Name<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Name</a></li>
                                        <li><a href="#">Author</a></li>
                                    </ul>
                                </div><!-- /btn-group -->

                                <input id="searchName" type="text" class="form-control">

                                <span class="input-group-btn">
                                                    <button onclick="search()" class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                            </div>

                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Search Results
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Publisher</th>
                                <th>Location</th>
                                <th>Availability</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                      <!--      --><?php
                            if(isset($result)) {

                                $arrlength = count($result);
                                for ($x = 0; $x < $arrlength; $x++) {

                                    $book = $result[$x];
                                    echo '<tr>
                                <td>' . $book->getISBN() . '</td>
                                <td>' . $book->getTitle() . '</td>
                                <td>' . $book->getAuthor() . '</td>
                                <td class="center">' . $book->getCategory() . '</td>
                                <td class="center">' . $book->getPublisher() . '</td>
                                <td>' . $book->getLocation() . '</td>
                                <td>' . $book->getQuantity() . '</td>
                                <td><a href="bookDetail.php?ISBN=' . $book->getISBN() . '"><button class="btn btn-outline btn-block btn-primary btn-sm">view</button></a></td>
                            </tr>';
                                }
                            }
                            ?>

                            </tbody>
                        </table>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../web/vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../web/vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../web/vendor/metisMenu/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../web/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../web/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="../web/vendor/datatables-responsive/dataTables.responsive.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../web/dist/js/sb-admin-2.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
                $(".dropdown-menu li a").click(function(){
                    $(this).parents(".dropdown").find('.btn').html($(this).text() + '<span class="caret"></span>');
                    $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
                });
            });


            function search() {
                var searchType=$("#searchType").text();
                var searchName=$("#searchName").val();
                if(searchName!=""){
                    window.location.href="search.php?type="+searchType+"&name="+searchName;
                }else {
                    alert("Please fill the search field!");
                }
            }
        </script>

</body>

</html>
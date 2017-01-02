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
    include_once ("../../dao/CategoryDao.php");
    require("../../service/adminValidator.php");
    include_once ("../../dao/BookDao.php");
    $categoryDao=new CategoryDao();
    $categories=$categoryDao->queryAll();
    $ISBN;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $dao=new BookDao();
        $ISBN=$_POST["ISBN"];
        $title=$_POST["title"];
        $author=$_POST["author"];
        $year_of_publish=$_POST["year_of_publish"];
        $category=(int)$_POST["category"];
        $publisher=$_POST["publisher"];
        $quantity=$_POST["quantity"];
        $location=$_POST["location"];
        $description=$_POST["description"];
        $image=$_POST["image"];
        $book=new Book();
        $book->setISBN($ISBN);
        $book->setTitle($title);
        $book->setAuthor($author);
        $book->setYearOfPublish($year_of_publish);
        $book->setCategoryId($category);
        $book->setPublisher($publisher);
        $book->setQuantity($quantity);
        $book->setLocation($location);
        $book->setDescription($description);
        $book->setImage($image);
        $dao->update($book);
    }else if(isset($_GET["ISBN"])){
        $ISBN=$_GET["ISBN"];
    }
    $dao=new BookDao();
    $book=$dao->queryById($ISBN);

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
                <h1 class="page-header"><?php echo $book->getISBN()?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Book Edit
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-12">
                                <?php if(isset($ISBN)){?>

                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <fieldset disabled>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="ISBN" name="ISBN" value="<?php echo $book->getISBN()?>" style="display: none">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Title" name="title" value="<?php echo $book->getTitle()?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Author" name="author" value="<?php echo $book->getAuthor()?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Publish Year" name="year_of_publish" value="<?php echo $book->getYearOfPublish()?>">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="category">
                                                <?php

                                                $arrlength=count($categories);
                                                for($x=0;$x<$arrlength;$x++) {
                                                    $category = $categories[$x];
                                                    if(strcmp($book->getCategoryId(),$category->getCategoryId()))
                                                        echo '<option value='.$category->getCategoryId().'>'.$category->getCategory().'</option>';
                                                    else
                                                        echo '<option value='.$category->getCategoryId().' selected>'.$category->getCategory().'</option>';

                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Publisher" name="publisher" value="<?php echo $book->getPublisher()?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Quantity" name="quantity" value="<?php echo $book->getQuantity()?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Location" name="location" value="<?php echo $book->getLocation()?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Description" name="description" value="<?php echo $book->getDescription()?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Cover" name="image" required="required" value="<?php echo $book->getImage()?>">
                                        </div>
                                    </fieldset>
                                    <div style="display: table;margin-left: auto;margin-right: auto">
                                        <a style="margin-right: 10px" class="btn btn-lg btn-primary btn-circle" onclick="$('fieldset').removeAttr('disabled');$('#button').removeAttr('disabled')"><i class="fa fa-edit"></i></a>
                                        <button id="button" type="submit" style="margin-left: 10px" class="btn btn-lg btn-success btn-circle" disabled><i class="fa fa-check"></i></button>
                                    </div>
                                </form>
                                <?php }?>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
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

</body>

</html>

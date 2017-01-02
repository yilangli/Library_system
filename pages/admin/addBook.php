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

    //retrieve form of book information
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
        $dao->save($book);
        header("Location: book.php?ISBN=".$ISBN);

    }


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
                <h1 class="page-header">Book</h1>
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

                                <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                                    <fieldset >
                                        <div class="form-group">
                                            <input class="form-control has-feedback" placeholder="ISBN" name="ISBN" onkeyup="validate(this.value)" required="required">
                                            <span id="validator" style="width: 75px;font-weight: bolder;" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Title" name="title" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Author" name="author" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Publish Year" name="year_of_publish" required="required" pattern="^\d{4}$" title="Please input correct year.">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="category" required="required" >
                                                <?php
                                                    $arrlength=count($categories);
                                                    for($x=0;$x<$arrlength;$x++) {
                                                        $category = $categories[$x];
                                                        echo '<option value='.$category->getCategoryId().'>'.$category->getCategory().'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Publisher" name="publisher" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Quantity" name="quantity" required="required" pattern="^\+?[1-9][0-9]*$" title="Please input number.">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Location" name="location" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Description" name="description" required="required">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Cover" name="image" required="required">
                                        </div>
                                    </fieldset>
                                    <div style="display: table;margin-left: auto;margin-right: auto">
                                        <button id="submit" type="submit" style="margin-left: 10px" class="btn btn-lg btn-success btn-circle"><i class="fa fa-check"></i></button>
                                    </div>
                                </form>
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


    <script>
        function validate(ISBN) {
            $.post("../../controller/ValidateController.php",{"ISBN":ISBN},function(data,status){

                if (!data){
                    $("#validator").removeClass("glyphicon-ok");
                    $("#validator").css("color","red");
                    $("#validator").text("Exist");
                    $("#submit").attr("disabled","true");
                }else{
                    $("#validator").addClass("glyphicon-ok");
                    $("#validator").css("color","green");
                    $("#validator").text("");
                    $("#submit").removeAttr("disabled");
                }
            });
        }
    </script>

</body>

</html>

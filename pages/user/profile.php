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
    require("../../service/userValidator.php");
    include_once ("../../dao/UserDao.php");
    include_once ("../../dao/RecordDao.php");
    $username=$_SESSION["username"];
    //retrieve form of profile and update it
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $dao=new UserDao();
        $username=$_POST["userName"];
        $password=$_POST["password"];
        $firstname=$_POST["firstName"];
        $lastname=$_POST["lastName"];
        $phone=$_POST["phone"];
        $email=$_POST["email"];
        $address=$_POST["address"];
        $user=new User();
        $user->setUserName($username);
        $user->setPassword($password);
        $user->setFirstName($firstname);
        $user->setLastName($lastname);
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setAddress($address);
        $dao->update($user);
    }
    $dao=new UserDao();
    $user=$dao->queryById($username);
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
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $username?></span> 's profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <span style="font-weight: bold; font-size: large;"> Profile Edit
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-12">

                                    <form role="form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        <fieldset disabled>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Username" name="userName" value="<?php echo $user->getUserName()?>" required="required" style="display: none" >
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Password" name="password" type="password" required="required" value="<?php echo $user->getPassword()?>"  pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$" title="input need includes upper, lower case and number">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="First Name" name="firstName" required="required"  value="<?php echo $user->getFirstName()?>">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Last Name" name="lastName" required="required" value="<?php echo $user->getLastName()?>">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Phone" name="phone" required="required" value="<?php echo $user->getPhone()?>">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Email" name="email" required="required" type="email" value="<?php echo $user->getEmail()?>">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Address" name="address" required="required" value="<?php echo $user->getAddress()?>">
                                            </div>

                                        </fieldset>
                                        <div style="display: table;margin-left: auto;margin-right: auto">
                                            <a style="margin-right: 10px" class="btn btn-lg btn-primary btn-circle" onclick="$('fieldset').removeAttr('disabled');$('#button').removeAttr('disabled')"><i class="fa fa-edit"></i></a>
                                            <button id="button" type="submit" style="margin-left: 10px" class="btn btn-lg btn-success btn-circle" disabled><i class="fa fa-check"></i></button>
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

</body>

</html>

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

    <!-- Custom CSS -->
    <link href="../web/dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="../web/css/landing-page.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="../web/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="../web/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../web/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../web/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../web/dist/js/sb-admin-2.js"></script>


    <style>
        .intro-header {
            background: url(../web/img/header.jpg) no-repeat center center;
        }

        .checkbox{
            color:black;
        }
    </style>
</head>

<body>


<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/2
 * Time: 21:34
 */
session_start();
require ("../dao/UserDao.php");
require ("../dao/AdminDao.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $method = $_POST["method"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $error1;
    $error2;
    if($method=="user"){
        $dao=new UserDao();
        $result=$dao->queryById($username);
        if(isset($result)&&!strcmp($result->getPassword(),$password)){
            $_SESSION["username"]=$username;
            $_SESSION["role"]="user";
            header("Location: user/dashboard.php");
        }else{
            $error1="incorrect username or password";
        }

    }elseif ($method=="admin"){
        $dao=new AdminDao();
        $result=$dao->queryById($username);
        if(isset($result)&&!strcmp($result->getPassword(),$password)){
            $_SESSION["username"]=$username;
            $_SESSION["role"]="admin";
            header("Location: admin/dashboard.php");
        }else{
            $error2="incorrect username or password";
        }
    }

}

?>




    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../index.php" class="navbar-brand topnav" style="font-size: x-large" >Library Management System</a>
            </div>

        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header" style="height: 100%">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default intro-message" style="padding-top: 0;padding-bottom: 0">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li id="utag" class="active"><a href="#user" data-toggle="tab" aria-expanded="false">Normal User</a>
                                </li>
                                <li  id="atag" class=""><a href="#admin" data-toggle="tab" aria-expanded="true">Administrator</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="user">
                                    <div class="panel-body">
                                        <form role="form" id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                            <fieldset>
                                                <div class="form-group" style="display: none">
                                                    <input  name="method" value="user" >
                                                </div>
                                                <span id="helpBlock" class="help-block"><?php if (isset($error1))echo $error1;?></span>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Username" name="username"  autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                                </div>
                                                <!-- Change this to a button or input when using this as a form -->
                                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                                <span style="color: darkgray">OR</span>
                                                <a href="signup.php" class="btn btn-lg btn-primary btn-block">Sign Up</a>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="admin">
                                    <div class="panel-body">
                                        <form role="form" id="form2"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
                                            <fieldset>
                                                <div class="form-group" style="display: none">
                                                    <input  name="method" value="admin" >
                                                </div>
                                                <span id="helpBlock" class="help-block"><?php if (isset($error2))echo $error2;?></span>                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Username" name="username" autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                                </div>
                                                <!-- Change this to a button or input when using this as a form -->
                                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>

                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

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

    <style>
        .intro-header {
            background: url(../web/img/header.jpg) no-repeat center center;
        }

    </style>
</head>

<body>




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
            <a href="../index.php" class="navbar-brand topnav"  style="font-size: x-large" >Library Management System</a>
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
                        <h3 class="panel-title">Please Sign Up</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="../controller/SignUpController.php" method="post">
                            <fieldset>
                                <div class="form-group has-feedback" id="user">
                                    <input class="form-control" placeholder="Username" name="username"  autofocus required="required" title="user name required" onkeyup="validate(this.value)">
                                    <span id="validator" style="width: 50px;font-weight: bolder;" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value=""  required="required" pattern="((?=.*[A-Z]).{4,20})" title="input need 4-20 letters and at least one capital letter">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="First Name" name="firstname" value=""  required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Last Name" name="lastname" value=""  required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone" name="phone"  value=""  required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="email" value=""  required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Address" name="address" value=""  required="required">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <button id="submit" type="submit" class="btn btn-lg btn-success btn-block" >Sign Up</button>
                            </fieldset>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<!-- jQuery -->
<script src="../web/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../web/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../web/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../web/dist/js/sb-admin-2.js"></script>

<script>
    function validate(name) {
        $.post("../controller/ValidateController.php",{username:name},function(data,status){

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

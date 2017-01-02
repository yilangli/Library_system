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
    <link href="web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="web/css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="web/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav"  style="font-size: x-large">Library Management System</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="pages/login.php">Log In</a>
                    </li>
                    <li>
                        <a href="pages/signup.php">Sign Up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header" style="height: 100%">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Book Search</h1>
                        <hr class="intro-divider">

                            <div class="form-group input-group" style="opacity: 0.7;width: 70%; margin-left: auto;margin-right: auto;">
                                    <div class="input-group-btn dropdown">
                                            <button id="searchType" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="searchType">Name<span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                              <li><a href="#">Name</a></li>
                                              <li><a href="#">Author</a></li>
                                            </ul>
                                    </div><!-- /btn-group -->

                                <input id="searchName" type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="search()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>

    <!-- jQuery -->
    <script src="web/vendor/jquery/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="web/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script>
        $(function(){
            $(".dropdown-menu li a").click(function(){
                $(this).parents(".dropdown").find('.btn').html($(this).text() + '<span class="caret"></span>');
                $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            });
        });

        function search() {
            var searchType=$("#searchType").text();
            var searchName=$("#searchName").val();
            if(searchName!=""){
                window.location.href="pages/search.php?type="+searchType+"&name="+searchName;
            }else {
                alert("Please fill the search field!");
            }
        }
    </script>

</body>

</html>

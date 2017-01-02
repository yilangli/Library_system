<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/16
 * Time: 18:07
 */
//logout service to erase session and redirect to homepage
session_start();
unset($_SESSION["username"]);
unset($_SESSION["role"]);
session_destroy();
header("Location: ../index.php");
<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/19
 * Time: 22:55
 */
//validation for admin role
session_start();
if(!isset($_SESSION["username"])&&strcmp($_SESSION["role"],"admin"))
    header("Location: ../login.php");
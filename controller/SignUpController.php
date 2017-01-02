<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/31
 * Time: 22:13
 */
    require ('../dao/UserDao.php');

//retrieve the posted from
    $username=$_POST["username"];
    $password=$_POST["password"];
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $address=$_POST["address"];




//using the posted information to create a user object
    $user=new User();
    $user->setUserName($username);
    $user->setPassword($password);
    $user->setFirstName($firstname);
    $user->setLastName($lastname);
    $user->setPhone($phone);
    $user->setEmail($email);
    $user->setAddress($address);

    $dao=new UserDao();
    $dao->save($user);

//redirect to the login page after registration
    $url="../pages/login.php";
    echo "<script language=\"javascript\">";
    echo "location.href=\"$url\"";
    echo "</script>";


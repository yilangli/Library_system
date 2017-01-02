<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/31
 * Time: 22:13
 */
//

require ('../dao/AdminDao.php');
/*
* @param $username
* @param $password
* @param $firstName
* @param $lastName
* @param $phone
* @param $email
* @param $address
*/

$username=$_POST["username"];
$password=$_POST["password"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$address=$_POST["address"];



//using posted parameters to create admin object

$user=new Admin();
$user->setAdminName($username);
$user->setPassword($password);
$user->setFirstName($firstname);
$user->setLastName($lastname);
$user->setPhone($phone);
$user->setEmail($email);
$user->setAddress($address);

//using admin dao access object interface to save admin's information to database.
$dao=new AdminDao();
$dao->save($user);

//redirect to the add admin page
$url="../pages/admin/addAdmin.php";
echo "<script language=\"javascript\">";
echo "location.href=\"$url\";";
echo "alert('Success added');</script>";
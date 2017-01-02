<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/20
 * Time: 14:10
 */
/*
* @param $id
* @param $username
* @param $ISBN
*/

//using record id, username, ISBN to update borrow record

    include_once ("../dao/RecordDao.php");
    $id=$_POST["id"];
    $recordDao=new RecordDao();
    $recordDao->delete($id);
    $username=$_POST["username"];
    $ISBN=$_POST["ISBN"];
    $bookDao=new BookDao();
    $book=$bookDao->queryById($ISBN);
    $book->setQuantity($book->getQuantity()+1);
    $bookDao->update($book);
    $userDao=new UserDao();
    $user=$userDao->queryById($username);
    $user->setLimits($user->getLimits()+1);
    $userDao->update($user);

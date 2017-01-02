<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/2
 * Time: 10:58
 */
    require ('../dao/UserDao.php');
    require ('../dao/BookDao.php');
    require ('../dao/AdminDao.php');
    require ('../dao/RecordDao.php');

//validation for the username, ISBN, adminname and record id to avoid duplicate primary key in each table
    if(isset($_POST["username"])) {
        $username = $_POST["username"];
        $dao = new UserDao();
        $result = $dao->queryById($username);
        if ($result == null)
            echo true;
        else
            echo false;
    }else if (isset($_POST["ISBN"])){
        $ISBN = $_POST["ISBN"];
        $dao = new BookDao();
        $result = $dao->queryById($ISBN);
        if ($result == null)
            echo true;
        else
            echo false;
    }else if (isset($_POST["adminname"])){
        $adminname = $_POST["adminname"];
        $dao = new AdminDao();
        $result = $dao->queryById($adminname);
        if ($result == null)
            echo true;
        else
            echo false;
    }

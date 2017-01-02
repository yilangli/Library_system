<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/27
 * Time: 19:59
 */

//connection establishment with database
class DBConn
{
    private static $server='mysql1.cs.clemson.edu';

    private static $username='lbrymngmnt_519r';

    private static $password='6620library';

    private static $database='library_management_x9fi';


    //get database connection
    public static function getConn(){
        $conn = new mysqli(DBConn::$server, DBConn::$username, DBConn::$password, DBConn::$database);

        if ($conn->connect_error) {
            die("connect failed: " . $conn->connect_error);
        }
        $conn->set_charset('utf8');
        return $conn;
    }

}


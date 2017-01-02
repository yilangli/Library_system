<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/12/2
 * Time: 20:26
 */
    include_once ("../dao/DBConn.php");
    include_once ("adminValidator.php");
    $table=$_GET["table"];
    //$mysqli=mysqli_connect("mysql1.cs.clemson.edu","lbrymngmnt_519r","6620library","library_management_x9fi");
    $mysqli=DBConn::getConn();
    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %sn", mysqli_connect_error());
        exit();
    }
    $tabledump = "DROP TABLE IF EXISTS $table;\n";
    $result = $mysqli->query("SHOW CREATE TABLE $table");
    $create = $result->fetch_row();
    $tabledump .= $create[1].";\n\n";

    $rows = $mysqli->query("SELECT * FROM $table");
    $numfields = $rows->field_count;
    while ($row = $rows->fetch_row()){
        $comma = "";
        $tabledump .= "INSERT INTO $table VALUES(";
        for($i = 0; $i < $numfields; $i++)
        {
            $tabledump .= $comma."'".$mysqli->real_escape_string($row[$i])."'";
            $comma = ",";
        }
        $tabledump .= ");\n";
    }
    $tabledump .= "\n";


    if(trim($tabledump))

    {

        //wirting basic information

        $sqldump =

            "# --------------------------------------------------------\n".

            "# Database backup\n".

            "#\n".

            "# Date: ".date('Y-m-d')."\n".

            "#\n".


            "# --------------------------------------------------------\n\n\n".

            $tabledump;
        ob_end_clean();
        header("Content-type:text/html;charset=UTF-8");
        header("Content-disposition:   filename=".$table.date("Ymd").".sql");
        header("Content-type:   application/octetstream");
        header("Pragma:   no-cache");
        header("Expires:   0");
        echo $sqldump;
    }

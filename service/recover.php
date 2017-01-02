<html>
<?

    include_once ("../dao/DBConn.php");
    $result="File upload failed";
    if ($_FILES["file"]["error"] > 0)
    {
        $result="File error";
    }
    else if(strrchr($_FILES["file"]["name"],".sql")==".sql")
    {
        $sql = file_get_contents($_FILES["file"]["tmp_name"]);
        $db=DBConn::getConn();
        $db->multi_query($sql);
        $result="Upload success";

    }
    $url="../pages/admin/database.php";
    echo "<script language=\"javascript\">";
    echo "alert(\"".$result."\");";
    echo "location.href=\"$url\";";
    echo "</script>";
?>
</html>
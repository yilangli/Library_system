<?php
/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/28
 * Time: 14:14
 */
include_once ('Dao.php');
include_once (__DIR__.'/../class/User.php');
include_once('DBConn.php');


//interface for user table
class UserDao implements Dao
{
    private $conn;

    function  __construct(){
        $this->conn = DBConn::getConn();
    }
//insert
    public function save($object)
    {
        // TODO: Implement save() method.
        $userName = $object->getUserName();
        $password= $object->getPassword();
        $firstName=$object->getFirstName();
        $lastName=$object->getLastName();
        $email=$object->getEmail();
        $phone = $object->getPhone();
        $address=$object->getAddress();

        $stmt = $this->conn->prepare("INSERT INTO user (userName, password, firstName, lastName, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $userName, $password, $firstName, $lastName,  $email, $phone, $address);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();

    }

    public function update($object)
    {
        // TODO: Implement update() method.
        $userName = $object->getUserName();
        $password= $object->getPassword();
        $firstName=$object->getFirstName();
        $lastName=$object->getLastName();
        $email=$object->getEmail();
        $phone = $object->getPhone();
        $address=$object->getAddress();
        $limits=$object->getLimits();

        $stmt = $this->conn->prepare("UPDATE user SET password=?, firstName=?, lastName=?,  email=?, phone=?, address=?, limits=? WHERE userName=?");
        $stmt->bind_param("ssssssis",  $password, $firstName, $lastName,  $email, $phone, $address, $limits, $userName);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

    public function delete($Id)
    {
        // TODO: Implement delete() method.

        $sql = "UPDATE user SET status=0 WHERE userName='$Id'";
        $this->conn->query($sql);;
        $this->conn->close();
    }

    public function queryAll()
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM user WHERE  status=1";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user=new User();
                $user->setUserName($row["userName"]);
                $user->setFirstName($row["firstName"]);
                $user->setLastName($row["lastName"]);
                $user->setEmail($row["email"]);
                $user->setPhone($row["phone"]);
                $user->setAddress($row["address"]);
                $user->setLimits($row["limits"]);
                array_push($list,$user);
            }
        }
        $this->conn->close();
        return $list;
    }

    public function queryById($Id)
    {
        // TODO: Implement queryById() method.
        $sql = "SELECT * FROM user WHERE userName='$Id' and status=1";
        $result = $this->conn->query($sql);
        $user=new User();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user->setUserName($row["userName"]);
            $user->setPassword($row["password"]);
            $user->setFirstName($row["firstName"]);
            $user->setLastName($row["lastName"]);
            $user->setEmail($row["email"]);
            $user->setPhone($row["phone"]);
            $user->setAddress($row["address"]);
            $user->setLimits($row["limits"]);
           // $this->conn->close();
            return $user;
        }else{
          //  $this->conn->close();
            return null;
        }

    }

    public function queryUser($Id)
    {
        // TODO: Implement queryById() method.
        $sql = "SELECT * FROM user WHERE userName='$Id'";
        $result = $this->conn->query($sql);
        $user=new User();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user->setUserName($row["userName"]);
            $user->setPassword($row["password"]);
            $user->setFirstName($row["firstName"]);
            $user->setLastName($row["lastName"]);
            $user->setEmail($row["email"]);
            $user->setPhone($row["phone"]);
            $user->setAddress($row["address"]);
            $user->setLimits($row["limits"]);
            $user->setStatus($row["status"]);
            // $this->conn->close();
            return $user;
        }else{
            //  $this->conn->close();
            return null;
        }

    }
}


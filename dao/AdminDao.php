<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/28
 * Time: 14:15
 */
include_once ('Dao.php');
include_once (__DIR__.'/../class/Admin.php');
include_once('DBConn.php');

// interface for admin table

class AdminDao implements Dao
{
    private $conn;

    function  __construct(){
        $this->conn = DBConn::getConn();
    }

    //insert a new admin information
    public function save($object)
    {
        // TODO: Implement save() method.
        $adminName = $object->getAdminName();
        $password= $object->getPassword();
        $firstName=$object->getFirstName();
        $lastName=$object->getLastName();
        $age=$object->getAge();
        $email=$object->getEmail();
        $phone = $object->getPhone();
        $address=$object->getAddress();

        $stmt = $this->conn->prepare("INSERT INTO admin (adminName, password, firstName, lastName,  email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $adminName, $password, $firstName, $lastName,  $email, $phone, $address);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
    //update the admin information with admin name
    public function update($object)
    {
        // TODO: Implement update() method.
        $adminName = $object->getAdminName();
        $password= $object->getPassword();
        $firstName=$object->getFirstName();
        $lastName=$object->getLastName();
        $age=$object->getAge();
        $email=$object->getEmail();
        $phone = $object->getPhone();
        $address=$object->getAddress();

        $stmt = $this->conn->prepare("UPDATE admin SET password=?, firstName=?, lastName=?, email=?, phone=?, address=? WHERE adminName=?");
        $stmt->bind_param("sssssss",  $password, $firstName, $lastName, $email, $phone, $address, $adminName);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
    //set admin account to invalid
    public function delete($Id)
    {
        // TODO: Implement delete() method.

        $sql = "UPDATE admin SET status=0 WHERE userName='$Id'";
        $this->conn->query($sql);;
        $this->conn->close();
    }
    //query all the admins' information
    public function queryAll()
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM admin WHERE  status=1";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $admin=new Admin();
                $admin->setAdminName($row["adminName"]);
                $admin->setFirstName($row["firstName"]);
                $admin->setLastName($row["lastName"]);
                $admin->setEmail($row["email"]);
                $admin->setPhone($row["phone"]);
                $admin->setAddress($row["address"]);
                array_push($list,$admin);
            }
        }
        $this->conn->close();
        return $list;
    }
    //query the admin's information with admin name
    public function queryById($Id)
    {
        // TODO: Implement queryById() method.
        $sql = "SELECT * FROM admin WHERE adminName='$Id' and status=1";
        $result = $this->conn->query($sql);
        $admin=new Admin();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $admin->setAdminName($row["adminName"]);
            $admin->setPassword($row["password"]);
            $admin->setFirstName($row["firstName"]);
            $admin->setLastName($row["lastName"]);
            $admin->setEmail($row["email"]);
            $admin->setPhone($row["phone"]);
            $admin->setAddress($row["address"]);
            $this->conn->close();
            return $admin;
        }else{
            $this->conn->close();
            return null;
        }

    }
}
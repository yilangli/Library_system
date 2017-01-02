<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/3
 * Time: 17:11
 */
require ('Dao.php');
require (__DIR__."/../class/Category.php");
require ('DBConn.php');


//interface for category table
class CategoryDao implements Dao
{
    private $conn;

    function  __construct(){
        $this->conn = DBConn::getConn();
    }
//insert a new category
    public function save($object)
    {
        // TODO: Implement save() method.
        $categoryId=$object->getCategoryId();
        $category=$object->getCategory();

        $stmt = $this->conn->prepare("INSERT INTO category (id, category) VALUES (?, ?)");
        $stmt->bind_param("is", $categoryId, $category);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
//update category information with category id
    public function update($object)
    {
        // TODO: Implement save() method.
        $categoryId=$object->getCategoryId();
        $category=$object->getCategory();

        $stmt = $this->conn->prepare("update category set category=? where id=?");
        $stmt->bind_param("si", $category, $categoryId);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }

    public function delete($object)
    {
        // TODO: Implement delete() method.
    }
    //query all book category
    public function queryAll()
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM category ";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $category = new Category();
                $category->setCategoryId($row["id"]);
                $category->setCategory($row["category"]);
                array_push($list,$category);
            }
        }
        $this->conn->close();
        return $list;
    }
    //query category with category id
    public function queryById($Id)
    {
        // TODO: Implement queryById() method.
        $sql = "SELECT * form category where id=$Id";
        $result = $this->conn->query($sql);
        $category=new Category();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $category->setCategoryId($row["id"]);
            $category->setCategory($row["category"]);
            return $category;
        }else{
            $this->conn->close();
            return null;
        }
    }
}
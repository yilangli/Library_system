<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/28
 * Time: 14:15
 */
include_once ('Dao.php');
include_once(__DIR__.'/../class/Book.php');
include_once('DBConn.php');

//interface for book table

class BookDao implements Dao
{
    private $conn;

    function  __construct(){
        $this->conn = DBConn::getConn();
    }
//insert a new book
    public function save($object)
    {
        // TODO: Implement save() method.
        $ISBN=$object->getISBN();
        $title=$object->getTitle();
        $author=$object->getAuthor();
        $yearofpublisher=$object->getYearOfPublish();
        $categoryId=$object->getCategoryId();
        $description=$object->getDescription();
        $image=$object->getImage();
        $publisher=$object->getPublisher();
        $quantity=$object->getQuantity();
        $location=$object->getLocation();

        $stmt = $this->conn->prepare("INSERT INTO book (ISBN, title, author, year_of_publish, categoryId, description, image, publisher, quantity, location) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiisssis", $ISBN, $title, $author, $yearofpublisher, $categoryId, $description, $image, $publisher, $quantity, $location);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
    //update the book with ISBN
    public function update($object)
    {
        // TODO: Implement save() method.
        $ISBN=$object->getISBN();
        $title=$object->getTitle();
        $author=$object->getAuthor();
        $yearofpublisher=$object->getYearOfPublish();
        $categoryId=$object->getCategoryId();
        $decription=$object->getDescription();
        $image=$object->getImage();
        $publisher=$object->getPublisher();
        $quantity=$object->getQuantity();
        $location=$object->getLocation();

        $stmt = $this->conn->prepare("UPDATE book SET  title=?, author=?, year_of_publish=?, categoryId=?, description=?, image=?, publisher=?, quantity=?, location=? WHERE ISBN=?");
        $stmt->bind_param("ssiisssiss", $title, $author, $yearofpublisher, $categoryId, $decription, $image, $publisher, $quantity, $location, $ISBN);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();

    }
    //set book to invalid
    public function delete($Id)
    {
        $sql = "UPDATE book SET status=0 WHERE ISBN='$Id'";
        $this->conn->query($sql);;
        $this->conn->close();
    }
    //query the book's information with ISBN
    public function queryById($Id)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM book b left join category c on b.categoryId=c.id WHERE ISBN='$Id' and status=1";
        $result = $this->conn->query($sql);
        $book=new Book();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $book->setISBN($row['ISBN']);
            $book->setTitle($row['title']);
            $book->setAuthor($row['author']);
            $book->setYearOfPublish($row['year_of_publish']);
            $book->setCategoryId($row['categoryId']);
            $book->setCategory($row['category']);
            $book->setDescription($row['description']);
            $book->setImage($row['image']);
            $book->setPublisher($row['publisher']);
            $book->setQuantity($row['quantity']);
            $book->setLocation($row['location']);
            //$this->conn->close();
            return $book;
        }else{
            return null;
        }


    }
    //query all books' information
    public function queryAll()
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM  book b left join category c on b.categoryId=c.id WHERE  status=1";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $book=new Book();
                $book->setISBN($row['ISBN']);
                $book->setTitle($row['title']);
                $book->setAuthor($row['author']);
                $book->setYearOfPublish($row['year_of_publish']);
                $book->setCategoryId($row['categoryId']);
                $book->setCategory($row['category']);
                $book->setDescription($row['description']);
                $book->setImage($row['image']);
                $book->setPublisher($row['publisher']);
                $book->setQuantity($row['quantity']);
                $book->setLocation($row['location']);
                array_push($list,$book);
            }
        }
        $this->conn->close();
        return $list;
    }

    //query books with the author name
    public function queryByAuthor($author)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM book b left join category c on b.categoryId=c.id WHERE author like '%$author%' and status=1";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $book=new Book();
                $book->setISBN($row['ISBN']);
                $book->setTitle($row['title']);
                $book->setAuthor($row['author']);
                $book->setYearOfPublish($row['year_of_publish']);
                $book->setCategoryId($row['categoryId']);
                $book->setCategory($row['category']);
                $book->setDescription($row['description']);
                $book->setImage($row['image']);
                $book->setPublisher($row['publisher']);
                $book->setQuantity($row['quantity']);
                $book->setLocation($row['location']);
                array_push($list,$book);
            }
        }
        $this->conn->close();
        return $list;
    }
    //query books with book name
    public function queryByName($name)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM book b left join category c on b.categoryId=c.id WHERE title like '%$name%' and status=1";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $book=new Book();
                $book->setISBN($row['ISBN']);
                $book->setTitle($row['title']);
                $book->setAuthor($row['author']);
                $book->setYearOfPublish($row['year_of_publish']);
                $book->setCategoryId($row['categoryId']);
                $book->setCategory($row['category']);

                $book->setDescription($row['description']);
                $book->setImage($row['image']);
                $book->setPublisher($row['publisher']);
                $book->setQuantity($row['quantity']);
                $book->setLocation($row['location']);
                array_push($list,$book);
            }
        }
        $this->conn->close();
        return $list;
    }
    //query all books'information with page split
    public function pageQueryAll($page, $pageSize)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM book b left join category c on b.categoryId=c.id WHERE  status=1 limit $page, $pageSize";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $book=new Book();
                $book->setISBN($row['ISBN']);
                $book->setTitle($row['title']);
                $book->setAuthor($row['author']);
                $book->setYearOfPublish($row['year_of_publish']);
                $book->setCategoryId($row['categoryId']);
                $book->setCategory($row['category']);

                $book->setDescription($row['description']);
                $book->setImage($row['image']);
                $book->setPublisher($row['publisher']);
                $book->setQuantity($row['quantity']);
                $book->setLocation($row['location']);
                array_push($list,$book);
            }
        }
        $this->conn->close();
        return $list;
    }

    //query all book with author name by page split
    public function pageQueryByAuthor($author,$page, $pageSize)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM book b left join category c on b.categoryId=c.id WHERE author like '%$author%' and status=1 limit $page, $pageSize";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $book=new Book();
                $book->setISBN($row['ISBN']);
                $book->setTitle($row['title']);
                $book->setAuthor($row['author']);
                $book->setYearOfPublish($row['year_of_publish']);
                $book->setCategoryId($row['categoryId']);
                $book->setCategory($row['category']);

                $book->setDescription($row['description']);
                $book->setImage($row['image']);
                $book->setPublisher($row['publisher']);
                $book->setQuantity($row['quantity']);
                $book->setLocation($row['location']);
                array_push($list,$book);
            }
        }
        $this->conn->close();
        return $list;
    }
    //query all books' information with book name by page split
    public function pageQueryByName($name, $page, $pageSize)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT * FROM book b left join category c on b.categoryId=c.id WHERE title like '%$name%' and status=1 limit $page, $pageSize";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $book=new Book();
                $book->setISBN($row['ISBN']);
                $book->setTitle($row['title']);
                $book->setAuthor($row['author']);
                $book->setYearOfPublish($row['year_of_publish']);
                $book->setCategoryId($row['categoryId']);
                $book->setCategory($row['category']);

                $book->setDescription($row['description']);
                $book->setImage($row['image']);
                $book->setPublisher($row['publisher']);
                $book->setQuantity($row['quantity']);
                $book->setLocation($row['location']);
                array_push($list,$book);
            }
        }
        $this->conn->close();
        return $list;
    }
}


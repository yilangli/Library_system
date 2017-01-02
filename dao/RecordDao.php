<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/28
 * Time: 14:16
 */
include_once ('Dao.php');
include_once (__DIR__.'/../class/BorrowRecord.php');
include_once ('DBConn.php');
include_once ('BookDao.php');
include_once ('UserDao.php');

//interface for borrowRecord table
class RecordDao implements Dao
{

    private $conn;

    function  __construct(){
        $this->conn = DBConn::getConn();
    }
    //insert a new book borrow record
    public function save($object)
    {
        // TODO: Implement save() method.
        $ISBN=$object->getISBN();
        $userName=$object->getUserName();
        $stmt = "INSERT INTO borrowRecord (ISBN, userName, borrow_date, return_date) VALUES ( '$ISBN', '$userName',  CURDATE(), DATE_ADD(CURDATE(),INTERVAL 10 DAY))";
        $this->conn->query($stmt);
        $this->conn->close();
    }
    //update book borrow record with record id
    public function update($object)
    {
        // TODO: Implement save() method.

        $Id=$object->getId();
        $borrowDate=$object->getBorrowDate();
        $returnDate=$object->getReturnDate();

        $stmt = $this->conn->prepare("update borrowRecord set  borrow_date?, return_date=? where id=?");
        $stmt->bind_param("ssi", $borrowDate, $returnDate, $Id);
        $stmt->execute();
        $stmt->close();
        $this->conn->close();
    }
    //set record status to invalid
    public function delete($Id)
    {
        // TODO: Implement delete() method.

        $sql = "UPDATE borrowRecord SET status=0 WHERE id='$Id'";
        $this->conn->query($sql);;
        $this->conn->close();
    }
    //query all book borrow record
    public function queryAll()
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT *, COUNT(*) as number 
            FROM borrowRecord b
            LEFT JOIN book book ON b.ISBN = book.ISBN
            WHERE b.status =1 group by b.ISBN order by number DESC limit 0,6 ";
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $record= new BorrowRecord();
                $record->setId($row['id']);
                $record->setISBN($row['ISBN']);
                $record->setUserName($row['userName']);
                $record->setBorrowDate($row['borrow_date']);
                $record->setReturnDate($row['return_date']);
                $bookDao=new BookDao();
                $book=$bookDao->queryById($row["ISBN"]);
                $record->setBook($book);
                array_push($list,$record);

            }
        }
        //$this->conn->close();
        return $list;
    }
    //query record with some order condition
    public function queryByCondition($condition)
    {
        // TODO: Implement queryAll() method.
        $sql = "SELECT *, COUNT(*) as number 
            FROM borrowRecord b
            LEFT JOIN book book ON b.ISBN = book.ISBN
            group by b.ISBN ".$condition;
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $record= new BorrowRecord();
                $record->setId($row['id']);
                $record->setISBN($row['ISBN']);
                $record->setUserName($row['userName']);
                $record->setBorrowDate($row['borrow_date']);
                $record->setReturnDate($row['return_date']);
                $bookDao=new BookDao();
                $book=$bookDao->queryById($row["ISBN"]);
                $record->setBook($book);
                array_push($list,$record);

            }
        }
        //$this->conn->close();
        return $list;
    }


    public function queryById($Id)
    {
        // TODO: Implement queryById() method.
    }
    //query book record with username
    public function  queryByUser($Id,$condition){

        $sql = "SELECT *
            FROM borrowRecord b
            LEFT JOIN book book ON b.ISBN = book.ISBN
            WHERE b.userName =  '$Id'
            AND b.status =1 ".$condition;
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $record= new BorrowRecord();
                $record->setId($row['id']);
                $record->setISBN($row['ISBN']);
                $record->setUserName($row['userName']);
                $record->setBorrowDate($row['borrow_date']);
                $record->setReturnDate($row['return_date']);
                $bookDao=new BookDao();
                $book=$bookDao->queryById($row["ISBN"]);
                $record->setBook($book);
                array_push($list,$record);

            }
        }
        //$this->conn->close();
        return $list;
    }
    //query record with book ISBN
    public function  queryByBook($Id){

    $sql = "SELECT * FROM borrowRecord WHERE ISBN='$Id' and status=1";
    $result = $this->conn->query($sql);
    $list = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $record= new BorrowRecord();
            $record->setId($row['id']);
            $record->setISBN($row['ISBN']);
            $record->setUserName($row['userName']);
            $record->setBorrowDate($row['borrow_date']);
            $record->setReturnDate($row['return_date']);
            array_push($list,$record);
        }
    }
    $this->conn->close();
    return $list;

}

    public function  queryByquery($sql){
        $result = $this->conn->query($sql);
        $list = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $record= new BorrowRecord();
                $record->setId($row['id']);
                $record->setISBN($row['ISBN']);
                $record->setUserName($row['userName']);
                $record->setBorrowDate($row['borrow_date']);
                $record->setReturnDate($row['return_date']);
                array_push($list,$record);
            }
        }
     //   $this->conn->close();
        return $list;

    }

}
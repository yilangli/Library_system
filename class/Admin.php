<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/28
 * Time: 11:12
 */
//class object-admin

class Admin
{
    private $adminName;
    private $password;
    private $firstName;
    private $lastName;
    private $age;
    private $phone;
    private $email;
    private $address;
    private $status;

    /**
     * Admin constructor.
     * @param $adminName
     * @param $password
     * @param $firstName
     * @param $lastName
     * @param $age
     * @param $phone
     * @param $email
     * @param $address
     * @param $status
     */



    /**
     * @return mixed
     */
    public function getAdminName()
    {
        return $this->adminName;
    }

    /**
     * @param mixed $adminName
     */
    public function setAdminName($adminName)
    {
        $this->adminName = $adminName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }




}
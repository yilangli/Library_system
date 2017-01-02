<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/10/28
 * Time: 11:58
 */
//parent interface for CRUD
interface Dao
{
    public function save($object);
    public function update($object);
    public function delete($object);
    public function queryAll();
    public function queryById($Id);
}
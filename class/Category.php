<?php

/**
 * Created by PhpStorm.
 * User: lyl_cs
 * Date: 2016/11/3
 * Time: 17:32
 */
//class object-category

class Category
{
    private $categoryId;

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    private $category;
}
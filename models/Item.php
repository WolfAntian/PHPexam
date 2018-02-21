<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 21/02/2018
 * Time: 18:08
 */

include("interfaces/IItem.php");

class Item implements \interfaces\IItem
{

    private $id;
    private $name;
    private $stock_level;
    private $price;

    /**
     * @param mixed $id
     * @param string $name
     * @param int $stock_level
     * @param float $price
     * @return mixed
     */
    public function create($id, $name, $stock_level, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->stock_level = $stock_level;
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  int $amount
     * @return bool
     */
    public function getIsInStock($amount)
    {
        return $this->stock_level >= $amount;
    }

    /**
     * @return $int
     */
    public function getStockLevel()
    {
        return $this->stock_level;
    }

    /**
     * @param  int $amount
     * @return bool
     */
    public function setStockLevel($amount)
    {
        $this->stock_level = $amount;
        return true;
    }
}
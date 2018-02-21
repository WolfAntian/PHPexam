<?php
namespace interfaces;

interface IItem
{
    /**
     * @param mixed $id
     * @param string $name
     * @param int $stock_level
     * @param float $price
     * @return mixed
     */
    public function create($id, $name, $stock_level, $price);

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @param int $amount
     * @return bool
     */
    public function getIsInStock($amount);

}
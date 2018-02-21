<?php

namespace interfaces;

interface ICart
{
    /**
     * @param mixed $item_id
     * @param int $quantity
     * @return bool
     */
    public function addItem($item_id, $quantity);

    /**
     * @param mixed $item_id
     * @param int $quantity
     * @return bool
     */
    public function changeQuantity($item_id, $quantity);


    /**
     * @param mixed $item_id
     * @return bool
     */
    public function removeItem($item_id);

    /**
     * @return array
     */

    public function getItems();

    /**
     *
     * @return float
     */
    public function sum();
}
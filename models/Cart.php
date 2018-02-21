<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 21/02/2018
 * Time: 18:00
 */

include("interfaces/ICart.php");

class Cart implements \interfaces\ICart
{

    private $items = [];

    /**
     * @param mixed $item_id
     * @param int $quantity
     * @return bool
     */
    public function addItem($item_id, $quantity)
    {
        if(!$this->changeQuantity($item_id, $quantity))
            return array_push($this->items, [
                "id" => $item_id,
                "quantity" => $quantity
            ]);


    }

    /**
     * @param mixed $item_id
     * @param int $quantity
     * @return bool
     */
    public function changeQuantity($item_id, $quantity)
    {
        foreach ($this->items as $item){
            if ($item_id == $item["id"]){
                $item["quantity"] = $quantity;
                return true;
            }
        }
        return false;
    }

    /**
     * @param mixed $item_id
     * @return bool
     */
    public function removeItem($item_id)
    {
        foreach ($this->items as $item){
            if ($item_id == $item["id"]){
                $this->items->detach($item);
                return true;
            }
            return false;
        }
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     *
     * @return float
     */
    public function sum()
    {
        $sum = 0.0;
        foreach ($this->items as $item){
            $sum += $item->getPrice();
        }
        return $sum;
    }

    public function clear(){
        $this->items = [];
    }
}
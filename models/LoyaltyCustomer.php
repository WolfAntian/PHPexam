<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 21/02/2018
 * Time: 18:50
 */

include("interfaces/ILoyaltyCustomer.php");

class LoyaltyCustomer extends Customer implements \interfaces\ILoyaltyCustomer
{

    private $discount = 0.0;

    /**
     * @param float $percentage
     * @return bool
     */
    public function setDiscount($percentage)
    {
        $this->discount = $percentage;
    }

    /**
     *
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 21/02/2018
 * Time: 18:37
 */

include("interfaces/ICustomer.php");

class Customer implements \interfaces\ICustomer
{

    private $name;
    private $funds;
    private $cart;

    /**
     * @param string $name
     * @param float $funds
     * @param ICart $cart
     * @return mixed
     */
    public function create($name, $funds, \interfaces\ICart $cart)
    {
        $this->name = $name;
        $this->funds = $funds;
        $this->cart = $cart;
    }

    /**
     * @return float
     */
    public function getFunds()
    {
        return $this->funds;
    }

    /**
     * param float $amount
     *
     * @return boolean
     */
    public function pay($amount)
    {
        if($amount <= $this->getFunds()){
            $this->funds -= $amount;
            return true;
        }
        return false;
    }

    /**
     * @return \interfaces\ICart
     */
    public function getCart()
    {
        return $this->cart;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
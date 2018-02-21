<?php

namespace interfaces;

interface ICustomer
{
    /**
     * @param string $name
     * @param float $funds
     * @param ICart $cart
     * @return mixed
     */
    public function create($name, $funds, ICart $cart);

    /**
     * @return float
     */
    public function getFunds();
}
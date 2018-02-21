<?php

namespace interfaces;

interface ILoyaltyCustomer extends ICustomer
{
    /**
     * @param float $percentage
     * @return bool
     */
    public function setDiscount($percentage);

}
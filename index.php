<?php

include("models/Item.php");
include("models/Cart.php");
include("models/Customer.php");
include("models/LoyaltyCustomer.php");

// 1. create products
    $wine = new Item();
    $wine->create("a", "Bottle of Wine", 5, 15.5);
    $choc = new Item();
    $choc->create("b", "Belgian Chocolate", 3, 9.3);
    $rose = new Item();
    $rose->create("c", "Rose", 99, 1.3);

    $items = [$wine, $choc, $rose];

// 2. create customers
    $john = new Customer();
    $john->create("John", 50.0, new Cart);

    $luke = new Customer();
    $luke->create("Luke", 30.2, new Cart);

    $jaina = new LoyaltyCustomer();
    $jaina->create("Jaina", 25.3, new Cart);
    $jaina->setDiscount(30);

    $lucy = new LoyaltyCustomer();
    $lucy->create("Lucy", 90.20, new Cart);
    $lucy->setDiscount(3);

// 3. purchase
//a. John buys 3 Bottles of Wine
    addItem($john, $wine, 3); //add to cart
    pay($john, $items); //pay
    $john->getCart()->clear(); //clears cart so they can purchase other items later
//b. Luke buys 5 Roses
    addItem($luke, $rose, 5);
    pay($luke, $items);
    $luke->getCart()->clear();
//c. John buys 2 Chocolates
    addItem($john, $choc, 2);
    pay($john, $items);
    $john->getCart()->clear();
//d. Jaina buys 2 Chocolates
    addItem($jaina, $choc, 2);
    pay($jaina, $items);
    $jaina->getCart()->clear();
//e. Jaina buys 1 Chocolate
    addItem($jaina, $choc, 1);
    pay($jaina, $items);
    $jaina->getCart()->clear();
//f. Luke buys 1 Bottle of wine
    addItem($luke, $wine, 1);
    pay($luke, $items);
    $luke->getCart()->clear();
//g. Jaina buys 12 Roses
    addItem($jaina, $rose, 12);
    pay($jaina, $items);
    $jaina->getCart()->clear();
//h. John buys 1 Bottle of wine
    addItem($john, $wine, 1);
    pay($john, $items);
    $john->getCart()->clear();
//i. Lucy buys 1 Bottle of wine
    addItem($lucy, $wine, 1);
    pay($lucy, $items);
    $lucy->getCart()->clear();

    echo "<br>";
// 4. print funds
    echo $john->getName() . ": £" . number_format($john->getFunds(), 2) . "<br>";
    echo $luke->getName() . ": £" . number_format($luke->getFunds(), 2) . "<br>";
    echo $jaina->getName() . ": £" . number_format($jaina->getFunds(), 2) . "<br>";
    echo $lucy->getName() . ": £" . number_format($lucy->getFunds(), 2) . "<br>";

    echo "<br>";
// 5. print stock
    echo $wine->getName() . ": " . $wine->getStockLevel() . "pcs <br>";
    echo $choc->getName() . ": " . $choc->getStockLevel() . "pcs <br>";
    echo $rose->getName() . ": " . $rose->getStockLevel() . "pcs <br>";

// 6. print history




//functions

function addItem($user, $item, $amount)
{
    echo $user->getName() . " is adding " . $amount . " " . $item->getName() . "<br>";
    if($item->getIsInStock($amount)){
        if($user->getCart()->addItem($item->getId(), $amount)) {
            echo $item->getName() . " added." . "<br>";
        }else{
            echo "failed." . "<br>";
        }

    }else{
        echo $item->getName() . " does not have enough stock." . "<br>";
    }
}


function pay($user, $shopItems){
    $cart = $user->getCart();
    $cartItems = $cart->getItems();
    $cost = 0.0;
    $continue = true;

    //check stock and price
    foreach($cartItems as $cartItem){
        foreach ($shopItems as $shopItem){
            if(strcmp($shopItem->getId(), $cartItem["id"]) == 0){
                $cost = $cost + $shopItem->getPrice() * $cartItem["quantity"];
                //$shopItem -= $cartItem["quantity"];
                if(!$shopItem->getIsInStock($cartItem["quantity"])) {
                    $continue = false;
                    echo $shopItem->getName() . " does not have enough stock." . "<br>";
                }
            }
        }
    }

    //apply discount
    if($user instanceof \interfaces\ILoyaltyCustomer){
        $cost = $cost - $cost*($user->getDiscount()/100);
    }

    //check if able to pay
    if($continue && $user->pay($cost)){
        //reduce item quantities
        foreach($cartItems as $cartItem){
            foreach ($shopItems as $shopItem){
                if(strcmp($shopItem->getId(), $cartItem["id"]) == 0){
                    $shopItem->setStockLevel($shopItem->getStockLevel() - $cartItem["quantity"]);
                }
            }
        }
        //clear cart
        $user->getCart()->clear();
        echo $user->getName() . " has payed." . "<br>";
    }else{
        echo "Not Enough Funds" . "<br>";
    }
}

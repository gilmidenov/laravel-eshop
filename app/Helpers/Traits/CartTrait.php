<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{
    public int $quantity = 1;

    public function addToCart(int $productId, $quantity = false)
    {
        $quantity = $quantity ? $this->quantity : 1;

        if ($quantity < 1) {
            $quantity = 1;
        }

        $res = Cart::addToCart($productId, $quantity);
    }
}

/*

'cart' => [
    1 => [
        'title' => '',
        'slug' => '',
        'image' => '',
        'price' => '',
        'old_price' => '',
        'quantity' => 4,
    ],
    5 => [
        'title' => '',
        'slug' => '',
        'image' => '',
        'price' => '',
        'old_price' => '',
        'quantity' => 3,
    ],
]

 * */

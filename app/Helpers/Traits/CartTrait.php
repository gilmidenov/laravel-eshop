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

        if (Cart::addToCart($productId, $quantity)) {
            $this->js("toastr.success('Product added to card successfully!')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Something went wrong!')");
        }
    }


    public function removeFromCart(int $productId)
    {
        if (Cart::removeProductFromCart($productId)) {
            $this->js("toastr.success('Product removed from card successfully!')");
            $this->dispatch('cart-updated');
        }else{
            $this->js("toastr.error('Something went wrong!')");
        }

    }
}

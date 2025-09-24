<?php

namespace App\Helpers\Cart;

use App\Models\Product;

class Cart
{
    /**
     * add product to cart
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    public static function addToCart(int $productId, int $quantity = 1)
    {
        $added = false;

        if (self::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => session("cart.{$productId}.quantity") + $quantity]);

            $added = true;
        } else {
            $product = Product::query()->find($productId);
            if ($product) {
                $new_product = [
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'price' => $product->price,
                    'old_price' => $product->old_price,
                    'quantity' => $quantity,
                ];
                session(["cart.{$productId}" => $new_product]);
                $added = true;
            }
        }

        return $added;
    }

    /**
     * get cart
     * @return array
     */
    public static function getCart(): array
    {
        return session('cart') ?: [];
    }

    /**
     * @return int
     */
    public static function getCartQuantityItems(): int
    {
        return count(self::getCart());
    }

    /**
     * @return int
     */
    public static function getCartQuantityTotal(): int
    {
        $cart = self::getCart();
        return array_sum(array_column($cart, 'quantity'));
    }

    /**
     * has product in cart
     * @param int $productId
     * @return bool
     */
    public static function hasProductInCart(int $productId): bool
    {
        return session()->has("cart.$productId");
    }
}

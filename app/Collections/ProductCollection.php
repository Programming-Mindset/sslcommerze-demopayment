<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class ProductCollection extends Collection
{
    public function inStock()
    {
        return $this->filter(fn($product) => $product->stock > 0);
    }

    public function expensive($price)
    {
        return $this->filter(fn($product) => $product->price > $price);
    }
}



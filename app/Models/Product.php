<?php

use App\Collections\ProductCollection;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function newCollection(array $models = [])
    {
        return new ProductCollection($models);
    }
}

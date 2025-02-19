<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class Movie extends Model
{
    use \Sushi\Sushi;


    protected $guarded = [];

    protected $casts = [
        "brand" => 'string',
         "category" => 'string',
         "description" => 'string',
         "id" => 'integer',
         "price" => 'float',
         "rating" => 'float',
         "thumbnail" => 'string',
         "title" => 'string'
    ];


    public function getRows()
    {
        //API
        $products = Http::get('https://dummyjson.com/products')->json();

        //filtering some attributes
        $products = Arr::map($products['products'], function ($item) {
            return Arr::only($item,
                [
                    "brand", "category", "description", "id", "price", "rating", "thumbnail", "title"
                ]
            );
        });

        // dd($products);

        return $products;
    }
}

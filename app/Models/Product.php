<?php

namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Sushi\Sushi;


class Product extends Model
{
    //

    use Sushi;


    protected $fillable = [
       "brand", "category", "description", "id", "price", "rating", "thumbnail", "title"
    ];

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

            // Limita los productos a solo 5 para pruebas
            $products = array_slice($products['products'], 0, 5);

            //filtering some attributes
            $products = Arr::map($products, function ($item) {
                return [
                    "brand" => (string) $item['brand'],
                    "category" => (string) $item['category'],
                    "description" => (string) $item['description'],
                    "id" => (int) $item['id'],
                    "price" => (float) $item['price'],
                    "rating" => (float) $item['rating'],
                    "thumbnail" => (string) $item['thumbnail'],
                    "title" => (string) $item['title']
                ];
            });

            return $products;
    }
}

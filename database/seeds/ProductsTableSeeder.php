<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            ['store_id' => 3, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 4, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 5, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 5, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 4, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 3, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 4, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 5, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],
            ['store_id' => 3, 'product_name' => str_random(10), 'product_code' => str_random(10), 'standard_price' => random_int(8000, 1000000), 'selling_price' => random_int(8000, 1000000), 'size' => str_random(3), 'style' => str_random(3)],

        );
        foreach ($products as $product) {
//            dd(var_dump($product));
            Product::create($product);

        }
        \Illuminate\Database\Eloquent\Model::reguard();
        //
    }
}

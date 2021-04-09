<?php

use Illuminate\Database\Seeder;
use App\models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class,4)->create();
    }
}

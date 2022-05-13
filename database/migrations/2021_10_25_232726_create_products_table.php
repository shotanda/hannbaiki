<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'products';
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('company_name',100);
            $table->string('product_name',100);
            $table->integer('price',10);
            $table->integer('stock',1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlueprintServiceProvide extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blue::macro('companyproducts',function(){
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->text('street_address');
            $table->timestamps();
        });
    }
}

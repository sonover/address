<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Sonover\Address\Models\AddressTypeProxy;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', AddressTypeProxy::values())->nullable()->default(AddressTypeProxy::defaultValue());
            $table->morphs('addressable');
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('province');
            $table->string('postalcode', 12)->nullable();
            $table->string('country');
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
        Schema::dropIfExists('addresses');
    }
}

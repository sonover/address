<?php

namespace Sonover\Address\Tests;

use Illuminate\Support\Collection;
use Sonover\Address\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Konekt\Address\Models\AddressProxy;
use Sonover\Address\Models\Addressable;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressableTraitTest extends TestCase {

    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $this->setupDatabase();
    }


    /** @test */
    public function has_many_addresses()
    {
        $customer = new Customer();

        $this->assertInstanceOf(Collection::class, $customer->addresses);
    }

    /** @test */
    public function get_billing_address() {

        $customer = new Customer();
        $this->assertInstanceOf(Collection::class, $customer->billingAddress);
    }

    /** @test */
    public function add_an_address() {

        $customer = Customer::create(['name' => 'Sonover Inc.']);
        $address = $customer->addAddress([
            'address' => 'Spring',
            'province' => 'St. George',
            'country' => 'GD'
        ], 'billing');

        tap($customer->fresh(), function($customer) use ($address) {
            $this->assertTrue($customer->billingAddress->contains($address));
        });
    }

    /** @test */
    public function remove_an_address() {

        $customer = Customer::create(['name' => 'Sonover Inc.']);
        $address = $customer->addAddress([
            'address' => 'Spring',
            'province' => 'St. George',
            'country' => 'GD'
        ], 'billing');

        $this->assertTrue($address->exists());

        $customer->removeAddress($address);

        $this->assertCount(0, $customer->addresses);
    }


    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase()
    {
        $this->app['db']->connection()->getSchemaBuilder()->create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        \Artisan::call('migrate', ['--force' => true]);
    }

}

class Customer extends Model {
    use Addressable;

    protected $guarded = ['id'];

}




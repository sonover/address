<?php

namespace Sonover\Address\Tests;

use Sonover\Address\Models\Address;
use Sonover\Address\Models\AddressProxy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function it_can_be_saved_to_database()
    {
        $address = AddressProxy::create([
            'country' => 'GD',
            'city' => 'Example City',
            'address'    => 'Baillie Bacolet',
            'addressable_type' => 'contact',
            'addressable_id' => 1,
            'province' => 'St. David',
            'postalcode' => 'GD473'
        ])->fresh();

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('GD', $address->country);
        $this->assertEquals('Baillie Bacolet', $address->address);
        $this->assertEquals('Example City', $address->city);
        $this->assertEquals('St. David', $address->province);
        $this->assertEquals('GD473', $address->postalcode);
    }
}

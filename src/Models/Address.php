<?php

namespace Sonover\Address\Models;

use Sonover\Address\Contracts\Address as AddressContract;
use Illuminate\Database\Eloquent\Model;


class Address extends Model implements AddressContract {

    protected $guarded = ['id'];

    public function scopeByType($query, $type) {
        return $query->where('type', $type);
    }

    /**
     * Get all of the owning addressable models.
     */
    public function addressable() {
        return $this->morphTo();
    }
}
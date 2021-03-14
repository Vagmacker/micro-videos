<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid as RamseyUuid;

trait Uuid
{
    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($obj) {
            $obj->id = RamseyUuid::uuid4();
        });
    }
}

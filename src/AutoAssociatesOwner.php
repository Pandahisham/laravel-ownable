<?php

namespace Tshafer\Ownable;

use Illuminate\Support\Facades\Auth;

trait AutoAssociatesOwner
{
    /**
     * Boots the trait.
     */
    protected static function bootAutoAssociatesOwner()
    {
        static::creating(function ($ownable) {
            $ownable->associateDefaultOwner();
        });
    }

    /**
     * Associates the default owner
     * By default it associates the logged in user
     * Override when needed.
     */
    public function associateDefaultOwner()
    {
        $owner = Auth::user();

        $this->associateOwner($owner);
    }
}

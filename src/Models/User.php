<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method find($id)
 */
class User extends Model
{
    /**
     * Relationship stating that a user
     * can have many merchants
     *
     * @return HasMany
     */
    public function merchants()
    {
        return $this->hasMany('App\Models\Merchant', 'belongs_to');
    }
}

<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;
use Bitsika\Artemis\Scopes\MerchantScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Merchant extends Model
{
    protected $table = 'users';

    /**
     * Relationship stating that a merchant belongs to
     * many admins of type User (sub-admins)
     *
     * @return BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Relationship stating that a merchant has
     * many invoices.
     *
     * @return HasMany
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'merchant_id');
    }

    /**
     * return paid invoices
     *
     * @return HasMany
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Invoice', 'merchant_id')->where('transaction_id', '!=', null);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}

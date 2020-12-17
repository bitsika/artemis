<?php

namespace Bitsika\Artemis\Models;

use Bitsika\Artemis\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method find($id)
 */
class User extends Model
{

    protected $fillable = ['recently_used_merchant'];

    /**
     * Relationship stating that a user
     * owns many merchants
     *
     * @return HasMany
     */
    public function merchantsOwned()
    {
        return $this->hasMany('App\Models\Merchant', 'belongs_to');
    }

    /**
     * Relationship stating that a user
     * has been added to many merchants
     *
     * @return HasMany
     */
    public function merchantsAddedTo()
    {
        return $this->hasManyThrough(
            'App\Models\Merchant',
            'App\Models\MerchantUserRole',
            'user_id',
            'id',
            'id',
            'merchant_id',
        );
    }

    /**
     * Relationship stating all merchants
     * a user belongs to and owns
     *
     * @return HasMany
     */
    public function merchants()
    {
        $merchantsOwnedByUser = $this->merchantsOwned;
        $merchantsUserWasAddedTo = $this->merchantsAddedTo;

        return $merchantsOwnedByUser->merge($merchantsUserWasAddedTo);
    }


    /**
     * Relationship stating the User's recently
     * used merchant
     *
     * @return HasOne
     */
    public function recentlyUsedMerchant()
    {
        return $this->hasOne('App\Models\Merchant', 'id', 'recently_used_merchant');
    }

    public function belongsToMerchant($merchant) : bool
    {
        $merchantsAddedTo   = MerchantUserRole::where('user_id', $this->id)
                                        ->where('merchant_id', $merchant->id)
                                        ->where('status', 'ACCEPTED');

        $merchantsOwned     = Merchant::where('id', $merchant->id)
                                    ->where('belongs_to', $this->id);

        return $merchantsAddedTo->exists() || $merchantsOwned->exists();
    }

    public function scopeWhereUser($query, string $value)
    {
        return $query->where('username', '=', $value)
                ->orWhere('email', '=', $value);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}

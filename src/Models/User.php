<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;
use Bitsika\Artemis\Enums\MerchantUserRole;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @method find($id)
 */
class User extends Model
{
    protected $hidden = ['pivot'];

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
     * can have many loans
     *
     * @return HasMany
     */
    public function loans()
    {
        return $this->hasMany('App\Models\Loan');
    }

    /**
     * Relationship stating that a user
     * can have many loan approvals
     *
     * @return HasMany
     */
    public function loanApprovals()
    {
        return $this->hasMany('App\Models\LoanApproval');
    }

    /**
     * Relationship stating that a user
     * has been added to many merchants
     *
     * @return HasManyThrough
     */
    public function merchantsAddedTo()
    {
        return $this->hasManyThrough(
            'App\Models\Merchant',
            'App\Models\MerchantInvite',
            'user_id',
            'id',
            'id',
            'merchant_id'
        );
    }

    /**
     * Relationship stating all merchants
     * a user belongs to and owns
     *
     * @return BelongsToMany
     */
    public function merchants()
    {
        return $this->belongsToMany(Merchant::class)
                ->withPivot('role_id', 'section')
                ->wherePivot('role_id', "!=" , MerchantUserRole::Suspended);
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

    public function belongsToMerchant($merchant): bool
    {
        return $this->merchants()
            ->whereMerchantId($merchant->id)
            ->where('role_id', '!=', MerchantUserRole::Suspended)
            ->exists();
    }

    public function scopeWhereUser($query, string $value)
    {
        return $query->where('username', '=', $value)
            ->orWhere('email', '=', $value);
    }
}

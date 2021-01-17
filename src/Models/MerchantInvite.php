<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantInvite extends Model
{
    protected $fillable = ['merchant_id', 'user_id', 'role_id'];

    /**
     * Relationship stating that this belongs
     * to a merchant
     *
     * @return BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant', 'merchant_id');
    }

    /**
     * Relationship stating that this belongs
     * to a user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Relationship stating that this belongs
     * to a role
     *
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\MerchantRole', 'role_id');
    }

}

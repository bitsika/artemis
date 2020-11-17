<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    /**
     * Relationship stating that an belongs
     * to a merchant
     *
     * @return BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant', 'merchant_id');
    }

    /**
     * Relationship stating that an belongs
     * to a user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'paid_by');
    }
}

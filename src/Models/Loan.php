<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method find($id)
 */
class Loan extends Model
{
    /**
     * Relationship stating that a loan
     * belongs to a user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relationship stating that a loan
     * has many approvals
     *
     * @return HasMany
     */
    public function approvals()
    {
        return $this->hasMany('App\Models\LoanApproval');
    }
}

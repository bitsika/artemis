<?php

namespace Bitsika\Artemis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method find($id)
 */
class LoanApproval extends Model
{
    /**
     * Relationship stating that a loan
     * approval belongs to a user
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
     * @return BelongsTo
     */
    public function loan()
    {
        return $this->belongsTo('App\Models\Loan');
    }
}

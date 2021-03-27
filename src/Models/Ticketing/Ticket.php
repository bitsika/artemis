<?php

namespace Bitsika\Artemis\Models\Ticketing;

use App\Models\User;
use Bitsika\Artemis\Enums\Ticketing\TicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'tickets';

    protected $fillable = [
        'cat_id',
        'buyer_id',
        'owner_id',
        'batch',
        'status',
        'identifier',
        'transfer_history',
    ];

	protected $casts = [
		'cat_id'    => 'int',
        'buyer_id'  => 'int',
        'owner_id'  => 'int',
        'status'    => 'string',
        'batch'     => 'string',
        'identifier' => 'string',
        'transfer_history' => 'array',
    ];

     // Setting default values if not set
     protected $attributes = [
        'status'    => TicketStatus::Reserved,
    ];

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'cat_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function isUsed()
    {
        return $this->status == TicketStatus::Used;
    }

    public function isReserved()
    {
        return $this->status == TicketStatus::Reserved;
    }

    /**
     * Scope to get tickets by category
     *
     * @param $category
     */
    public function scopeWhereCategory($query, $category)
    {
        return $query->where('cat_id', '=', $category->id);
    }

    /**
     * Scope to get tickets by status
     *
     * @param $status
     */
    public function scopeWhereStatus($query, int $status)
    {
        return $query->where('status', '=', $status);
    }

    /**
     * Scope to get tickets by batch
     *
     * @param $status
     */
    public function scopeWhereBatch($query, string $batch)
    {
        return $query->where('batch', '=', $batch);
    }

    /**
     * Scope to get tickets by buyer's id
     *
     * @param $status
     */
    public function scopeWhereBuyer($query, int $userId)
    {
        return $query->where('buyer_id', '=', $userId);
    }

}

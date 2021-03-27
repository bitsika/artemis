<?php

namespace Bitsika\Artemis\Models\Ticketing;

use Bitsika\Artemis\Enums\Ticketing\TicketCategoryStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_categories';

    protected $fillable = [
        'title',
        'price',
        'status',
        'currency',
        'event_id',
        'max_no_of_tickets',
        'no_of_tickets_sold',
    ];

	protected $casts = [
		'title' => 'string',
        'price' => 'float',
        'status' => 'int',
        'currency' => 'string',
        'event_id' => 'int',
        'max_no_of_tickets' => 'int',
        'no_of_tickets_sold' => 'int',
    ];

    // Setting default values if not set
    protected $attributes = [
        'status'    => TicketCategoryStatus::Active,
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function isActive()
    {
        return $this->status == TicketCategoryStatus::Active;
    }

    public function isCancelled()
    {
        return $this->status == TicketCategoryStatus::Cancelled;
    }

    public function hasEnoughTicketSlots(int $noOfTickets) : bool
    {
        return $this->no_of_tickets_available >= $noOfTickets;
    }

    /**
     * Get the ticket's no_of_tickets_available.
     *
     * @param  string  $value
     * @return string
     */
    public function getNoOfTicketsAvailableAttribute()
    {
        return $this->max_no_of_tickets - $this->no_of_tickets_sold;
    }

    /**
     * Ensure the no_of_tickets_sold is not a negative value.
     *
     * @param  string  $value
     * @return void
     */
    public function setNoOfTicketsSoldAttribute($value)
    {
        $this->attributes['no_of_tickets_sold'] = max($value, 0);
    }

}

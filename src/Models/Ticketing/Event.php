<?php

namespace Bitsika\Artemis\Models\Ticketing;

use Bitsika\Artemis\Enums\Ticketing\EventStatus;
use Bitsika\Artemis\Enums\Ticketing\EventVerification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table    = 'events';
    protected $with     = ['ticketCategories'];

    protected $dates = [
        'end_date',
        'start_date',
    ];

    protected $fillable = [
        'slug',
        'title',
        'venue',
        'status',
        'verified',
        'end_date',
        'start_date',
        'description',
        'organizer_id',
        'venue_on_maps',
        'display_picture'
    ];

    // Setting default values if not set
    protected $attributes = [
        'status'    => EventStatus::Active,
        'verified'  => EventVerification::NotVerified,
    ];

    /**
     * Relationship stating that an event
     * belongs to a user
     *
     * @return HasOne
     */
    public function organizer()
    {
        return $this->belongsTo('App\Models\User', 'organizer_id');
    }

    public function ticketCategories()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function isActive()
    {
        return $this->status == EventStatus::Active;
    }

    public function isVerified()
    {
        return $this->verified == EventVerification::Verified;
    }

    public function isInActive()
    {
        return $this->status == EventStatus::OnHold;
    }

    public function isCancelled()
    {
        return $this->status == EventStatus::Cancelled;
    }

}

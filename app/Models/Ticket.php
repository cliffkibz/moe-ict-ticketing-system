<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Ticket
 *
 * @property Carbon|null $resolved_at
 * @property Carbon $created_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|static latest($column = null)
 * @method static static create(array $attributes = [])
 * @method static static findOrFail($id, $columns = ['*'])
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestor_name',
        'office_contact',
        'department',
        'location',
        'category',
        'email',
        'issue',
        'remarks',
        'ticket_no',
        'status',
        'resolved_at',
        'priority',
        'assigned_to',
        'rating',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'rating' => 'integer',
    ];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Duration in minutes between creation and resolution, null if not resolved
    public function getResolutionMinutesAttribute(): ?int
    {
        if (!$this->resolved_at) {
            return null;
        }
        return (int) ceil(($this->resolved_at->floatDiffInSeconds($this->created_at)) / 60);
    }
}

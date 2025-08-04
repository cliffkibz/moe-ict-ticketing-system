<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ticket
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
        'department',
        'email',
        'issue',
        'remarks',
        'ticket_no',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Properties
 *
 * @property string $id
 * @property ?string $user_id
 * @property ?string $ip_address
 * @property ?string $user_agent
 * @property string $payload
 * @property int $last_activity
 *
 * Relations
 * @property-read ?User $user
 */
class Session extends Model
{
    /**
     * Sessions use string primary keys, not auto-incrementing integers.
     */
    public $incrementing = false;

    /**
     * The primary key is a string (session token), not an integer.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are guarded from mass assignment.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * Get the user that owns the session.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use NiftyCo\Attachments\Attachment;
use NiftyCo\Attachments\Casts\AsAttachment;
use NiftyCo\Attachments\Concerns\HasAttachmentCleanup;

/**
 * Properties
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property ?string $remember_token
 * @property ?Attachment $avatar
 * @property UserRole $role
 * @property ?Carbon $confirmed_at
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 *
 * Relations
 * @property-read \Illuminate\Database\Eloquent\Collection<Session> $sessions
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Authenticatable, Authorizable, HasAttachmentCleanup, HasFactory, HasUuids, Notifiable, SoftDeletes;

    /**
     * The attributes that are guarded from mass assignment.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'avatar' => AsAttachment::class,
        ];
    }

    /**
     * Get the user's active sessions.
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}

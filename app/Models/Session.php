<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NiftyCo\Support\Session\Agent;

class Session extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $appends = ['platform', 'browser', 'isDesktop'];

    protected function casts(): array
    {
        return [
            'last_active_at' => 'datetime',
            'location' => 'json',
        ];
    }

    protected function isDesktop(): Attribute
    {
        return Attribute::make(get: fn() => tap(new Agent(), function ($agent) {
            return $agent->setUserAgent($this->user_agent);
        })->isDesktop());
    }

    protected function platform(): Attribute
    {
        return Attribute::make(get: fn() => tap(new Agent(), function ($agent) {
            return $agent->setUserAgent($this->user_agent);
        })->platform());
    }

    protected function browser(): Attribute
    {
        return Attribute::make(get: fn() => tap(new Agent(), function ($agent) {
            return $agent->setUserAgent($this->user_agent);
        })->browser());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Concerns;

trait HasHashId
{
    /**
     * Find a model by its hash ID (hashid).
     *
     * @return static|null
     */
    public static function findByHashId(string $hashId)
    {
        return static::find(hashid_decode($hashId));
    }

    /**
     * Get the hash ID (hashid) for this model.
     */
    public function getHashIdAttribute(): string
    {
        return hashid_encode($this->getKey());
    }
}

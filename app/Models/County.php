<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'badge'];

    public function cities()
    {
        return $this->hasMany(City::class, 'id_county');
    }

    /**
     * Resolves the badge column to a usable <img src>: local paths (as
     * stored by the seeder) go through asset(), external URLs (typed into
     * the edit form) are used as-is.
     */
    public function getBadgeUrlAttribute(): ?string
    {
        if (! $this->badge) {
            return null;
        }

        return str_starts_with($this->badge, 'http') ? $this->badge : asset($this->badge);
    }
}

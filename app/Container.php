<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference',
        'is_valid'
    ];

    /**
     * Allowed filter types
     *
     * @var array
     */
    public static $filters = [
        'all',
        'invalid'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tradeflows()
    {
        return $this->belongsToMany(Tradeflow::class);
    }

    /**
     * Get only invalid containers
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInvalid(Builder $query)
    {
        return $query->where('is_valid', false);
    }

    /**
     * Get only valid containers
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid(Builder $query)
    {
        return $query->where('is_valid', true);
    }
}

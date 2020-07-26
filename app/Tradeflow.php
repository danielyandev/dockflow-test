<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tradeflow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Allowed filter types
     *
     * @var array
     */
    public static $filters = [
        'all',
        'without-containers',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function containers()
    {
        return $this->belongsToMany(Container::class)->where('is_valid', true);
    }

}

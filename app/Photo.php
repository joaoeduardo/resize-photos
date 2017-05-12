<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public function dimensions()
    {
        return $this->hasMany(Dimension::class);
    }
}

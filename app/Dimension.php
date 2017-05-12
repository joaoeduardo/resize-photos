<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Dimension extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['photo_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}

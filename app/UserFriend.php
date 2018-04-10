<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'UserFriend';

    /**
     * The primary key associated with model.
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

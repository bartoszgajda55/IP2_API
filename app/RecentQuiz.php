<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentQuiz extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'RecentQuiz';

    /**
     * The primary key associated with model.
     *
     * @var string
     */
    protected $primaryKey = 'RecentID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

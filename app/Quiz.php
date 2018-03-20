<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Quiz';

    /**
     * The primary key associated with model.
     *
     * @var string
     */
    protected $primaryKey = 'QuizID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Question';

    /**
     * The primary key associated with model.
     *
     * @var string
     */
    protected $primaryKey = 'QuestionID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the quiz that owns the question.
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedQuiz extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'FeaturedQuiz';

    /**
     * The primary key associated with model.
     *
     * @var string
     */
    protected $primaryKey = 'FeatureID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

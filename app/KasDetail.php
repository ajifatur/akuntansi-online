<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ac_jvdetail';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'jvid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seq', 'glaccount', 'glamount', 'description',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

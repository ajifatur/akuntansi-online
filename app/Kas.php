<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ac_jv';

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
        'jvnumber', 'transdate', 'glperiod', 'glyear', 'source', 'transtype', 'catid', 'transdescription', 'jvamount', 'glhistid', 'iduser', 'idkantor', 'status', 'inputtime', 'locked', 'lockedby', 'projectid',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

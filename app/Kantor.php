<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cs_kantor';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idkantor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namakantor', 'alamat', 'telepon', 'fax', 'groupid', 'endofservice'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

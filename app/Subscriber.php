<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscriber';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_subscriber';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_package', 'subscriber_email', 'subscriber_url', 'subscriber_key', 'subscriber_version', 'subscriber_at', 'subscriber_up'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

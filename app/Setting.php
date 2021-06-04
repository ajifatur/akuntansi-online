<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'setting_name', 'setting_category', 'setting_rules', 'setting_key', 'setting_value', 'setting_order'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

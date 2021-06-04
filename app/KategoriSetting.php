<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori_setting';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_ks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kategori', 'slug', 'prefix'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

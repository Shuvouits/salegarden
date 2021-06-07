<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BrandModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    protected $guraded = ['brand_id'];
    protected $fillable = [
        'brand_track_id',
        'brand_name',
        'brand_status',
    ];

}

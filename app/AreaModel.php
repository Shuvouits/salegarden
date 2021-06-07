<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaModel extends Model {

    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'areas';
    protected $primaryKey = 'area_id';
    protected $guraded = ['area_id'];
    protected $fillable = [
        'area_track_id',
        'area_name',
        'area_status',
    ];

}

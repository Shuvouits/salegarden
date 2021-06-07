<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SecondCategoryModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'second_category';
    protected $primaryKey = 'second_category_id';
    protected $guraded = ['second_category_id'];
    protected $fillable = [
        'second_category_name',
        'second_category_track_id',
        'second_category_category_id',
        'second_category_sub_id',
        'second_category_status',
    ];

}

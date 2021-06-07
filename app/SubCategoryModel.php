<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubCategoryModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sub_category';
    protected $primaryKey = 'sub_category_id';
    protected $guraded = ['sub_category_id'];
    protected $fillable = [
        'sub_category_name',
        'sub_category_track_id',
        'sub_category_category_id',
        'sub_category_status',
    ];

}

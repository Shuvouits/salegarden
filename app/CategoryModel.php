<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $guraded = ['category_id'];
    protected $fillable = [
        'category_track_id',
        'category_name',
        'category_status',
    ];

}

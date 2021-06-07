<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReviewModel extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'review';
    protected $primaryKey = 'review_id';
    protected $guraded = ['review_id'];
    protected $fillable = [
        'review_track_id',
        'review_details',
        'review_star',
        'review_product_id',
        'review_status'
    ];

}

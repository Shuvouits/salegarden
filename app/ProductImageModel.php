<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductImageModel extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product_image';
    protected $primaryKey = 'product_image_id';
    protected $guraded = ['product_image_id'];
    protected $fillable = [
        'product_image_product_id',
        'product_image_file',
    ];
}

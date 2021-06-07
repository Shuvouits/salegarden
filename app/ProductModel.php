<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model {

    use SoftDeletes;

use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $guraded = ['product_id'];
    protected $fillable = [
        'product_title',
        'product_users_id',
        'product_track_id',
        'product_country',
        'product_no',
        'product_category_id',
        'product_sub_category_id',
        'product_second_category_id',
        'product_brand_id',
        'product_featured',
        'product_price',
        'product_description',
        'product_mobile',
        'product_type',
        'product_view',
        'product_discount',
        'product_discount_price',
        'product_discount_percentage',
        'product_negotiable',
        'product_status',
        'product_image',
        'product_division',
        'product_order_date',
        'product_review'
    ];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class, 'users_track_id');
    }

    public function brand() {
        return $this->belongsTo(BrandModel::class, 'brand_track_id');
    }

}

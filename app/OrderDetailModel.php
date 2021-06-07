<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderDetailModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $guraded = ['id'];
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'amount',
    ];

    public function order() {
        return $this->belongsTo(OrderModel::class, 'order_id', 'order_track_id');
    }

    public function product() {
        return $this->belongsTo(ProductModel::class, 'product_id', 'product_track_id')->withTrashed();
    }

}

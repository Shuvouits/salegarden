<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $guraded = ['order_id'];
    protected $fillable = [
        'order_users_id',
        'order_track_id',
        'order_ip',
        'order_status',
        'order_delivery',
        'order_address',
        'order_payment',
        'order_note',
        'order_name',
        'order_mobile',
        'order_payment_type',
        'order_area',
    ];

    public function orderDetails() {
        return $this->hasMany(OrderDetailModel::class, 'order_id', 'order_track_id');
    }

}

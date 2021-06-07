<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\UserResetPasswordNotification;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'users_id';
    protected $guraded = ['users_id'];
    protected $fillable = [
        'users_name',
        'users_email',
        'users_mobile',
        'users_username',
        'users_track_id',
        'users_type',
        'users_status',
        'password',
        'users_image',
        'users_rejection_note',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products() {
        return $this->hasMany(ProductModel::class, 'product_users_id', 'users_track_id');
    }

    public function getEmailForPasswordReset() {
        return $this->users_email;
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function routeNotificationForMail()
    {
        if ($email = request()->input('users_email')) {
            return $email;
        }

        return $this->users_email;
    }

}

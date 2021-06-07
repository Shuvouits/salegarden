<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ContactModel extends Model {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "contact";
    protected $primaryKey = 'contact_id';
    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_subject',
        'contact_message'
    ];
    protected $guarded = ['contact_id'];

}

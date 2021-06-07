<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class CompanyInfoModel extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'company_info';
    protected $primaryKey = 'company_info_id';
    protected $guraded = ['company_info_id'];
    protected $fillable = [
        'company_info_users_id',
        'company_info_website',
        'company_info_phone',
        'company_info_contact_person',
        'company_info_contact_person_mobile',
        'company_info_contact_person_position',
        'company_info_contact_person_email',
        'company_info_logo',
        'company_info_description'
    ];
}

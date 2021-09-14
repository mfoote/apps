<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'chart_number', 'external_id', 'external_id_type', 'form_id', 'form_name', 'website',
        'conversion_type', 'converted_call', 'ip_address', 'first_name', 'middle_initial', 'last_name', 'suffix',
        'alias', 'date_of_birth', 'web_postal_code', 'initial_comment', 'created_user_id', 'updated_user_id'
    ];

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function primary_address()
    {
        return $this->hasMany(ContactAddress::class, 'contact_id', 'id')->where('is_primary', 1)->take(1);
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function primary_phone_number()
    {
        return $this->hasMany(ContactPhoneNumber::class, 'contact_id', 'id')->where('is_primary', 1)->take(1);
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function primary_email_address()
    {
        return $this->hasMany(ContactEmailAddress::class, 'contact_id', 'id')->where('is_primary', 1)->take(1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(ContactAddress::class, 'contact_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phone_numbers()
    {
        return $this->hasMany(ContactPhoneNumber::class, 'contact_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function email_addresses()
    {
        return $this->hasMany(ContactEmailAddress::class, 'contact_id', 'id');
    }
}

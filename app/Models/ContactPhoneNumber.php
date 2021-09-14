<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'phone_number_type', 'is_primary'];

    public function getPhoneNumberAttribute($value)
    {
        $number = preg_replace("/[^\d]/", "", $value);
        $length = strlen($value);
        if ($length == 10) {
            $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $value);
        }
        return $number;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return $this->hasOne(Contact::class, 'id', 'contact_id');
    }
}

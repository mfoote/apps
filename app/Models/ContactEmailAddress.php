<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmailAddress extends Model
{
    use HasFactory;

    protected $fillable = ['email_address', 'email_address_type', 'is_primary'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact()
    {
        return $this->hasOne(Contact::class, 'id', 'contact_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'contact_id', 'user_id', 'updated_user_id', 'category', 'note', 'follow_up_on', 'follow_up_done'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function update_user()
    {
        return $this->hasOne(User::class, 'id', 'updated_user_id');
    }
}

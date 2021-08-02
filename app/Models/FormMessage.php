<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormMessage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'form_id', 'message', 'form_meta', 'tracking_meta', 'ip_address', 'status'
    ];
    protected $casts = [
        'form_meta' => 'array',
        'tracking_meta' => 'array'
    ];
    /**
     * Get the form associated with the message.
     */
    public function form()
    {
        return $this->hasOne(Form::class);
    }
}

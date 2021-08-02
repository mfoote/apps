<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'email', 'comments', 'form_meta', 'tracking_meta', 'ip_address'
    ];
    protected $casts = [
        'form_meta' => 'array',
        'tracking_meta' => 'array'
    ];

    /**
     * Get the messages associated with the form.
     */
    public function messages()
    {
        return $this->hasMany(FormMessage::class);
    }

    /**
     * Get the notes associated with the form.
     */
    public function notes()
    {
        return $this->hasMany(FormNote::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($form) {
            $form->messages()->each(function ($message) {
                $message->delete();
            });
            $form->notes()->each(function ($note) {
                $note->delete();
            });
        });
    }
}

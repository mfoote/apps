<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'form_id', 'note', 'form_meta', 'tracking_meta', 'ip_address', 'status'
    ];
    protected $casts = [
        'form_meta' => 'array',
        'tracking_meta' => 'array'
    ];
    /**
     * Get the form associated with the note.
     */
    public function form()
    {
        return $this->hasOne(Form::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpGfEntry extends Model
{
    use HasFactory;

    protected $table = 'wp_gf_entry';
    protected $connection = 'sca';
    protected $fillable = ['is_fulfilled', 'status', 'transaction_id'];

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function form()
    {
        return $this->hasOne(WpGfForm::class, 'id', 'form_id');
    }

    public function form_entry_meta()
    {
        return $this->hasMany(WpGfEntryMeta::class, 'entry_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpGfForm extends Model
{
    use HasFactory;
    protected $table = 'wp_gf_form';
    protected $connection = 'sca';

    public function form_meta(){
        return $this->hasOne(WpGfFormMeta::class, 'form_id', 'id');
    }
    public function form_entries(){
        return $this->hasMany(WpGfEntry::class, 'form_id', 'id');
    }
}

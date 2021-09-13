<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpGfFormMeta extends Model
{
    use HasFactory;
    protected $table = 'wp_gf_form_meta';
    protected $connection = 'sca';
    protected $casts  = [
        'display_meta' => 'array'
    ];
}

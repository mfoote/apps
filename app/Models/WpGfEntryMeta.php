<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpGfEntryMeta extends Model
{
    use HasFactory;
    protected $table = 'wp_gf_entry_meta';
    protected $connection = 'sca';
}

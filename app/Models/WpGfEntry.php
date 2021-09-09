<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpGfEntry extends Model
{
    use HasFactory;

    protected $table = 'wp_gf_entry';
    protected $connection = 'remote';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function form_entry_meta()
    {
        return $this->hasMany(WpGfEntryMeta::class, 'entry_id', 'id');
    }
}

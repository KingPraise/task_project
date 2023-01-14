<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroWeapons extends Model
{
    use HasFactory;
    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }
    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'point_x',
        'point_y',
        'note',
    ];
    public function Lines()
    {
        return $this->hasMany(Lines::class);
    }
}

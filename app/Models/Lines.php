<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lines extends Model
{
    use HasFactory;
    protected $fillable=[
        'premise',
        'stable',
        'note',
    ];
    public function Region() {
        return $this->belongsTo(Regions::class);
    }
    public function Excursions()
    {
        return $this->hasMany(Excursions::class);
    }
    public function Positions()
    {
        return $this->hasMany(Positions::class);
    }
}

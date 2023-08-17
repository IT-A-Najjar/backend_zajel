<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wagons extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'modle',
        'number_chairs',
        'car_number',
        'note',
    ];
    public function Excursions()
    {
        return $this->hasMany(Excursions::class);
    }
}

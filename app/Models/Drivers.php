<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'age',
        'experience',
        'note',
    ];
    public function Excursions()
    {
        return $this->hasMany(Excursions::class);
    }
}

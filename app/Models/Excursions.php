<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class Excursions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'time',
        'driver_id',
        'bus_id',
        'line_id',
        'note',
    ];
    public function Driver() {
        return $this->belongsTo(Drivers::class);
    }
    public function Wagon() {
        return $this->belongsTo(Wagons::class);
    }
    public function Line() {
        return $this->belongsTo(Lines::class);
    }
}

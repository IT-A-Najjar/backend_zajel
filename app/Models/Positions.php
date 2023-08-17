<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'point_x',
        'point_y',
        'line_id',
        'note',
    ];
    public function Line() {
        return $this->belongsTo(Lines::class);
    }
}

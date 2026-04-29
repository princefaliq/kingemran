<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'spa_program_id',
        'content',
        'is_active',
    ];

    public function spaProgram()
    {
        return $this->belongsTo(SpaProgram::class);
    }
}

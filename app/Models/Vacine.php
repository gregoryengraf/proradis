<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacine extends Model
{
    use HasFactory;
    protected $fillable = ['manufacturer','expirationDate','lote','dosesNumber', 'daysInterval'];

     // Relationships

    public function patients()
    {
        return $this->belongsToMany(Patient::class);
    }
}

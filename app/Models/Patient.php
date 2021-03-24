<?php

namespace App\Models;

use App\Models\Vacine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['fullName','dateOfBirth','cpf','gender'];


    // Relationships

    /**
     * The roles that belong to the user.
     */
    public function vacines()
    {
        return $this->belongsToMany(Vacine::class)->withTimestamps();
    }
}

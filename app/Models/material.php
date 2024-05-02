<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    use HasFactory;

    public function agent(){
        return $this->belongsTo(agent::class,'matricule', 'matricule');
    }

    //
    public function maintenances(){
        return $this->hasMany(maintenance::class, 'codeONEE', 'codeONEE');
    }

    //
    public function enregistrements(){
        return $this->hasMany(enregistrement::class, 'codeONEE', 'codeONEE');
    }

    //
    public function declarations(){
        return $this->hasMany(declaration::class, 'codeONEE', 'codeONEE');
    }
}

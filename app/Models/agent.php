<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    use HasFactory;

    public function entite(){
        return $this->belongsTo(entite::class,'refEntite', 'refEntite');
    }

    public function materials(){
        return $this->hasMany(material::class,'matricule', 'matricule');
    }
    
    //
    public function enregistrements(){
        return $this->hasMany(enregistrement::class, 'matricule', 'matricule');
    }

    //
    public function declarations(){
        return $this->hasMany(declaration::class, 'matricule', 'matricule');
    }
}

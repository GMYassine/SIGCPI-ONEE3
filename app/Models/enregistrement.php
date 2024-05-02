<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enregistrement extends Model
{
    use HasFactory;

    public function material(){
        return $this->belongsTo(material::class, 'codeONEE', 'codeONEE');
    }

    public function agent(){
        return $this->belongsTo(agent::class,'matricule', 'matricule');
    }
}

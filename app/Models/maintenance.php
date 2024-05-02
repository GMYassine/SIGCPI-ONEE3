<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
{
    use HasFactory;
    //
    public function societe_maintenance(){
        return $this->belongsTo(societe_maintenance::class, 'refSM', 'refSM');
    }

    //
    public function material(){
        return $this->belongsTo(material::class, 'codeONEE', 'codeONEE');
    }
}

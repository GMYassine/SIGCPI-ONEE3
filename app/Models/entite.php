<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entite extends Model
{
    use HasFactory;
    
    protected $fillable = ['nomEntite','libelleEntite'];

    public function agents(){
        return $this->hasMany(agent::class,'refEntite', 'refEntite');
    }
    
}

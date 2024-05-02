<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class societe_maintenance extends Model
{
    use HasFactory;

    protected $fillable = ['nomSM','libelleSM','emailSM'];

    //
    public function maintenances(){
        return $this->hasMany(maintenance::class, 'refSM', 'refSM');
    }
}

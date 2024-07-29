<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{

    protected $table="permiso";

    protected $fillable = [
        'id', 'rol_id','nombre','fecha'
    ];


    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'role_permission', 'idpermiso', 'idrol');
    }
}

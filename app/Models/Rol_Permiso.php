<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol_Permiso extends Model
{

    protected $table="rol_permiso";

    protected $fillable = [
        'idrol','idpermiso'
    ];
}

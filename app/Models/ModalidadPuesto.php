<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalidadPuesto extends Model
{
    use HasFactory;
    protected $table = 'modalidad_puesto';

    protected $fillable = [

        'nombre',

    ];
}

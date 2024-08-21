<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    use HasFactory;
    protected $table = 'accion_oi';

    protected $fillable = [

        'nombre',
        'color',
        'domain_id'
    ];

    public function domain() {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelCargo extends Model
{
    use HasFactory;
    protected $table = 'nivel_cargo';

    protected $fillable = [

        'nombre',
        'domain_id'

    ];

    public function domain() {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}

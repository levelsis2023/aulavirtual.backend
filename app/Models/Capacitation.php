<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capacitation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'capacitations';

    protected $fillable = [
        'cv_bank_id',
        'uuid',
        'name',
        'user_id',
        'status',
        'advance',
        'image',
        'insitution',
        'date_start',
        'date_end',
        'time',
        'type',
        'level_position',
        'score',
        'observation',
        'validated'
    ];

        // nueva propiedad con la url de la imagen

        protected $appends = ['image_url'];

        public function getImageUrlAttribute()
        {
            return $this->image ? url("storage/$this->image") : null;
        }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function advanceStatus()
    {
        return $this->belongsTo(EstadoAvance::class, 'advance');
    }


    public function typeCapacitation()
    {
        return $this->belongsTo(TipoCapacitacion::class, 'type');
    }

    public function positionLevel()
    {
        return $this->belongsTo(NivelCargo::class, 'level_position');
    }

    public function status(){
        return $this->belongsTo(EstadoActual::class, 'status');
    }
}

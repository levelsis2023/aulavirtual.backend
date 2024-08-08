<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicFormation extends Model
{
    use HasFactory;

    protected $table = 'academic_formation';


    protected $fillable=[
        'uuid',
        'cv_bank_id',
        'user_id',
        'education',
        'profession',
        'con',
        'image',
        'status',
        'advance',
        'institute',
        'date_start',
        'date_end',
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

    public function professionModel(){
        return $this->belongsTo(Profesion::class, 'profession');
    }

    public function educationDegree(){
        return $this->belongsTo(GradoInstruccion::class, 'education');
    }

    public function advanceStatus()
    {
        return $this->belongsTo(EstadoAvance::class, 'advance');
    }

}
<?php

namespace App\Models;

use App\Models\CvBank\CvBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_order',
        'exp_siaf',
        'certif_siaf',
        'fecha',
        'proveedor',
        'concepto',
        'mon',
        'valor',
        'state_id',
        'cv_bank_id',
        'domain_id'
    ];

    public function cv_bank()
    {
        return $this->belongsTo(CvBank::class);
    }

    public function domain() {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;
    protected $table = 'managements';

    protected $fillable = [
        'description',
        'domain_id'
    ];

    public function domain() {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}

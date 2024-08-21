<?php

namespace App\Models\Maintenance;

use App\Models\PersonalDocumentaryFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementDocumentType extends Model
{
    use HasFactory;

    protected $table = "management_document_types";

    protected $fillable = [
        'name',
        'domain_id'
    ];

    public function personalDocumentaryFiles()
    {
        return $this->hasMany(PersonalDocumentaryFile::class, 'management_document_type_id');
    }

    public function domain() {
        return $this->belongsTo(Domain::class, 'domain_id');
    }
}

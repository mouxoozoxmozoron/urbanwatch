<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsidenceAttacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'incidence_id', 'type', 'attachement', 'status', 'archive'
    ];

    public function incidence()
    {
        return $this->belongsTo(Incidence::class);
    }

    public function attachmentType()
    {
        return $this->belongsTo(AttachementType::class, 'type');
    }
}

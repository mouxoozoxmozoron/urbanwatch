<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'tittle', 'latitude', 'longitude', 'user_name',
        'phone', 'region', 'district', 'ward', 'resolve_status',
        'archive', 'status'
    ];

    public function attachments()
    {
        return $this->hasMany(InsidenceAttacement::class);
    }

    public function statuses()
    {
        return $this->belongsTo(IncidenceStatus::class, 'resolve_status');
    }

    public function consultant()
    {
        return $this->belongsTo(Company::class, 'assigned_company');
    }
}

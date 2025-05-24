<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'status',
        'archive',
        'admin_id',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function bases()
    {
        return $this->belongsTo(CompanyCategory::class, 'category');
    }

    public function incidences()
    {
        return $this->belongsTo(Incidence::class, 'assigned_company');
    }
}

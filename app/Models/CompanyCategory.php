<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    //


    public function bases()
    {
        return $this->hasMany(Company::class, 'category');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cattle extends Model
{
    use HasFactory;

    protected $table = 'cattles';

    protected $fillable = ['serial' ,'gender', 'age', 'pasture_id', 'weight', 'color', 'price'];

    public function pasture()
    {
        return $this->belongsToMany(pasture::class, 'cattle_pasture', 'cattle_id', 'pasture_id');
    }
}

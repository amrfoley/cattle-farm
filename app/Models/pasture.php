<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasture extends Model
{
    use HasFactory;

    protected $fillable = ['grass', 'temperature', 'weather', 'bulls', 'cows', 'name'];

    public function cattles()
    {
        return $this->belongsToMany(cattle::class, 'cattle_pasture', 'pasture_id', 'cattle_id');
    }
}

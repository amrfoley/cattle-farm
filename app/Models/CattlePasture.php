<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CattlePasture extends Model
{
    use HasFactory;

    protected $fillable = ['pasture_id', 'cattle_id'];
    protected $table = 'cattle_pasture';

    public function pastures()
    {
        return $this->belongsTo(pasture::class, 'pasture_id', 'id');
    }

    public function cattles()
    {
        return $this->belongsTo(cattle::class, 'cattle_id', 'id');
    }
}

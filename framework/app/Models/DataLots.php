<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataLots extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nlote',
        'nivel',
        'marca_id',
        'observaciones',
        'fabricacion',
        'expiracion'
    ];

    public function marca() {
        return $this->belongsTo('App\Models\DataBrand', 'marca_id')->withTrashed();
    }


    use HasFactory;
}

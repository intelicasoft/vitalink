<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataModels extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'short_name',
        'description',
        'links',
        'brand_id',
        'status',
    ];

    public function brand() {
        return $this->belongsTo('App\Models\DataBrand', 'brand_id')->withTrashed();
    }

    use HasFactory;
}

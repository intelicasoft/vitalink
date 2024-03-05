<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataBrand extends Model
{
    use SoftDeletes;
    
    protected $table = 'data_brands';

    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
    ];

}
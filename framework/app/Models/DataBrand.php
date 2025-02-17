<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataBrand extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'type', 
        'description',
        'client_id',
        'status',
    ];


    use HasFactory;
}

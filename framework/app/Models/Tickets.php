<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tickets extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status',
        'description',
        'title',
        'manager_id',
        'failure',
        'category',
        'priority',
        'adress',
        'lab_name',
        'phone',
        'extension',
        'contact',
        'equipment_id',
        'images',
        'number_id',
        'user_id'
    ];

    public function equipment() {
        return $this->belongsTo('App\Equipment', 'equipment_id')->withTrashed();
    }

    public function manager() {
        return $this->belongsTo('App\User', 'manager_id')->withTrashed();
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }
    
    use HasFactory;
}

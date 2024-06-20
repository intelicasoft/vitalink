<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reviews extends Model
{
    
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        
        'description',
        'images',
        'user_id',
        'equipment_id',
        
    ];

    public function user() {
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
	}

    public function equipment() {
        return $this->belongsTo('App\Equipment', 'equipment_id')->withTrashed();
    }
}

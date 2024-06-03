<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrders extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'status',
        'user_sign',
        'specialist_sign',
        'send_emails',
        'user_id',
        'ticket_id',
        'images',
        'maintenance_id',
        'pdf',
        'number_id',
    ];

    public function user() {
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
	}

    public function ticket() {
        return $this->belongsTo('App\Models\Tickets', 'ticket_id')->withTrashed();
    }

    use HasFactory;
}

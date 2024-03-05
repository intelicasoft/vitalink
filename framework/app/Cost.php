<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cost extends Model {
	use SoftDeletes;
	protected $table = 'costs';
	protected $guard_name = 'web';

	public function hospital() {
		return $this->belongsTo('App\Hospital', 'hospital_id')->withTrashed();
	}
}

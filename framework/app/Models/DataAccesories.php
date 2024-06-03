<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataAccesories extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nombre',
        'proveedor_id',
        'catalogo',
        'lote_id',
        'inventario',
        'costo',
        'observaciones',
    ];

    public function lote() {
		return $this->belongsTo('App\Models\DataLots', 'lote_id')->withTrashed();
	}
    
    public function proveedor() {
        return $this->belongsTo('App\Models\DataProviders', 'proveedor_id')->withTrashed();
    }

    use HasFactory;
}

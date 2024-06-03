<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAccesories;
use App\Models\DataLots;
use App\Models\DataProviders;

// use App\Role;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Spaite\Permission\Role;
use App\QrGenerate;
use Illuminate\Support\Collection;
use App\Http\Requests\EquipmentRequest;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use DateTime;

class DataAccesoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$this->availibility('View accesories');
		$index['page'] = 'accesories';
		$index['accesories'] = DataAccesories::all();

        return view('data_accesories.index',$index);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'accesories';
        $index['lotes'] = DataLots::all();
        $index['proveedores'] = DataProviders::all();
        return view('data_accesories.create',$index);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'lote_id' => 'required',
            'proveedor_id' => 'required',
            'catalogo' => 'required',
            'inventario' => 'nullable|numeric',
            'costo' => 'nullable|numeric',
            'observaciones' => 'nullable',
        ]);

        DataAccesories::create($data);
        
        return redirect()->route('accesories.index')->with('success', 'Accesory created successfully.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accesory = DataAccesories::findOrFail($id);
        return view('data_accesories.create',$accesory);
  
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index['accesory'] = DataAccesories::findOrFail($id);
        $index['lotes'] = DataLots::all();
        $index['proveedores'] = DataProviders::all();
        $index['page'] = 'accesories';
        
        return view('data_accesories.edit', $index);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'lote_id' => 'required',
            'proveedor_id' => 'required',
            'catalogo' => 'required',
            'inventario' => 'nullable',
            'costo' => 'nullable',
            'observaciones' => 'nullable',
        ]);
        
        
        $accesory = DataAccesories::findOrFail($id);
        $accesory->update($data);
        
        return redirect()->route('accesories.index')->with('success', 'Accesory updated successfully.');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accesory = DataAccesories::findOrFail($id);
        $accesory->delete();
        
        return redirect()->route('accesories.index')->with('success', 'Accesory deleted successfully.');
    }

    public static function availibility($method)
	{
		// $r_p = \Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();
		if (\Auth::user()->hasDirectPermission($method)) {
			return true;
		} else {
			abort('401');
		}
		// if (\Auth::user()->hasDirectPermission($method)) {
		// 	return true;
		// } elseif (!in_array($method, $r_p)) {
		// 	abort('401');
		// } else {
		// 	return true;
		// }
	}
}


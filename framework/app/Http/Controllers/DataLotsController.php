<?php

namespace App\Http\Controllers;

use App\Models\DataBrand;
use Illuminate\Http\Request;
use App\Models\DataLots;

class DataLotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$this->availibility('View lots');
		$index['page'] = 'lots';
		$index['lots'] = DataLots::all();

		// return view('hospitals.index', $index);
        return view('data_lots.index',$index);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'lots';
        $index['marcas'] = DataBrand::all();
        return view('data_lots.create',$index);
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
            'nlote' => 'required',
            'nivel' => 'required',
            'marca_id' => 'required',
            'observaciones' => 'nullable',
            'fabricacion' => 'nullable',
            'expiracion' => 'nullable',
        ]);
        
        DataLots::create($data);
        
        return redirect()->route('lots.index')->with('success', 'Lot created successfully.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lot = DataLots::findOrFail($id);
        return view('data_lots.create',$lot);
  
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index['lot'] = DataLots::findOrFail($id);
        $index['marcas'] = DataBrand::all();
        $index['page'] = 'lots';
        
        return view('data_lots.edit', $index);
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
            'nlote' => 'required',
            'nivel' => 'required',
            'marca_id' => 'required',
            'observaciones' => 'nullable',
            'fabricacion' => 'nullable',
            'expiracion' => 'nullable',
        ]);
        
        
        $lot = DataLots::findOrFail($id);
        $lot->update($data);
        
        return redirect()->route('lots.index')->with('success', 'lot updated successfully.');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lot = DataLots::findOrFail($id);
        $lot->delete();
        
        return redirect()->route('lots.index')->with('success', 'lot deleted successfully.');
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


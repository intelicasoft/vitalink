<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataZones;
use Auth;
use App\User;

class DataZonesController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		//$this->availibility('View zones');
		$index['page'] = 'zones';
		$index['zones'] = DataZones::all();

		// return view('hospitals.index', $index);
        return view('data_zones.index',$index);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'zones';
        return view('data_zones.create',$index);
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
            'zone' => 'required', 
            'name' => 'required',
            'manager_email' => 'required|email',
        ]);
        
        DataZones::create($data);
        
        return redirect()->route('zones.index')->with('success', 'Zone created successfully.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = DataZones::findOrFail($id);
        return view('data_zones.create',$zone);
  
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index['zone'] = DataZones::findOrFail($id);
        $index['page'] = 'zones';
        
        return view('data_zones.edit', $index);
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
            
            'zone' => 'required',
            'name' => 'required',
            'manager_email' => 'required|email',
        ]);
        
        $zone = DataZones::findOrFail($id);
        $zone->update($data);
        
        return redirect()->route('zones.index')->with('success', 'Zone updated successfully.');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = DataZones::findOrFail($id);
        $zone->delete();
        
        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully.');
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

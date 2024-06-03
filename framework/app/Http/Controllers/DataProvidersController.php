<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataProviders;
use Auth;
use App\User;

class DataProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		//$this->availibility('View providers');
		$index['page'] = 'providers';
		$index['providers'] = DataProviders::all();

		// return view('hospitals.index', $index);
        return view('data_providers.index',$index);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'providers';
        return view('data_providers.create',$index);
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
            'observaciones' => 'required',
        ]);
        
        DataProviders::create($data);
        
        return redirect()->route('providers.index')->with('success', 'Provider created successfully.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = DataProviders::findOrFail($id);
        return view('data_providers.create',$provider);
  
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index['provider'] = DataProviders::findOrFail($id);
        $index['page'] = 'providers';
        
        return view('data_providers.edit', $index);
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
            'observaciones' => 'required',
        ]);
        
        $provider = DataProviders::findOrFail($id);
        $provider->update($data);
        
        return redirect()->route('providers.index')->with('success', 'Provider updated successfully.');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = DataProviders::findOrFail($id);
        $provider->delete();
        
        return redirect()->route('providers.index')->with('success', 'Provider deleted successfully.');
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

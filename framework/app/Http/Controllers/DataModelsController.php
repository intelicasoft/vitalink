<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBrand;
use App\Models\DataModels;
use Auth;
use App\User;

class DataModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		//$this->availibility('View models');
		$index['page'] = 'models';
        
		$index['models'] = DataModels::all();

		// return view('hospitals.index', $index);
        return view('data_models.index',$index);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'models';
        $index['marcas'] = DataBrand::all();
        return view('data_models.create',$index);
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
            'name' => 'required',
            'short_name' => 'required',
            'brand_id' => 'required', 
            'description' => 'required',
            'links' => 'nullable',
        ]);
        
        DataModels::create($data);
        
        return redirect()->route('models.index')->with('success', 'Model created successfully.');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = DataModels::findOrFail($id);
        return view('data_models.create',$model);
  
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index['model'] = DataModels::findOrFail($id);
        $index['marcas'] = DataBrand::all();
        $index['page'] = 'models';
        
        return view('data_models.edit', $index);
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
            'name' => 'required',
            'short_name' => 'required',
            'brand_id' => 'required', 
            'description' => 'required',
            'links' => 'nullable'
        ]);
        
        $model = DataModels::findOrFail($id);
        $model->update($data);
        
        return redirect()->route('models.index')->with('success', 'Model updated successfully.');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = DataModels::findOrFail($id);
        $model->delete();
        
        return redirect()->route('models.index')->with('success', 'Model deleted successfully.');
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

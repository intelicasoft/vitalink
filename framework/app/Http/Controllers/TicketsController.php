<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Equipment;
use App\User;
use App\Models\ServiceOrders;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->availibility('View tickets');
		$index['page'] = 'Tickets';
		$index['tickets'] = Tickets::all();

        return view('tickets.index',$index);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $index['page'] = 'accesories';
        $index['equipments'] = Equipment::all();
        $index['managers'] = User::where('role_id', 1)->get();
        $index['user'] = Auth::user();
        return view('tickets.create',$index);
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
            'description' => 'required',
            'title' => 'required',
            'model' => 'required', //agregue el campo 'model
            'manager_id' => 'required',
            'failure' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'adress' => 'required',
            'lab_name' => 'nullable',
            'phone' => 'required',
            'extension' => 'required',
            'contact' => 'required',
            'equipment_id' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user_id = auth()->user()->id;
        $number_id = Tickets::max('number_id');
        //guardar la imagen base64

        $image = $request->file('images');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        $data['images'] = $imageName;

        $data['status'] = 1;
        $data['number_id'] = $number_id+1;

        $data['user_id'] = $user_id;

        Tickets::create($data);

        //voy a crear la orden de servicio con al infroamcion del ticket
        $order['status'] = $data['status'];
        $order['number_id'] = $data['number_id'];
        $order['user_id'] = $data['user_id'];
        $order['ticket_id'] = Tickets::max('id');
        $order['images'] = $data['images'];
        $order['equipment_id'] = $data['equipment_id'];
        

        ServiceOrders::create($order);
        

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $index['page'] = 'accesories';
        $index['equipments'] = Equipment::all();
        $index['managers'] = User::where('role_id', 1)->get();
        $index['user'] = Auth::user();
        $index['ticket'] = Tickets::find($id);

        return view('tickets.edit',$index);
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
        $ticket = Tickets::findOrFail($id);
        
        $data = $request->validate([
            'number_id' => 'required|unique:tickets,number_id,' . $ticket->id,
            'description' => 'required',
            'title' => 'required',
            'model' => 'required',
            'manager_id' => 'required',
            'failure' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'adress' => 'required',
            'lab_name' => 'nullable',
            'phone' => 'required',
            'extension' => 'required',
            'contact' => 'required',
            'equipment_id' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
    
        $image = $request->file('images');

        if ($image) {
            // Si se carga una nueva imagen, guardarla y actualizar el campo de la imagen
            if ($ticket->images) {
                $image_path = public_path('images') . '/' . $ticket->images;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $data['images'] = $imageName;
    
            // También actualizar la imagen en la orden de servicio
            $order = ServiceOrders::where('ticket_id', $id)->first();
            if ($order) {
                $order->images = $imageName;
                $order->number_id = $data['number_id'];
                $order->update();
            }
        }

        $ticket->update($data);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminar la imagen guardada en images
        $ticket = Tickets::find($id);
        $ticket->number_id=0;
        $ticket->update();
        $image_path = public_path().'/images/'.$ticket->images;
        unlink($image_path);

        Tickets::destroy($id);
        ServiceOrders::where('ticket_id', $id)->delete();

    

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');


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

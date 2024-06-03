<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Models\ServiceOrders;
use App\Models\Tickets;
use App\User;
use Illuminate\Http\Request;
use PDF;

class ServiceOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->availibility('View orders');
		$index['page'] = 'Orders';
		$index['orders'] = ServiceOrders::all();

        return view('serviceorders.index',$index);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->availibility('Edit orders');
        $edit['page'] = 'Orders';
        $edit['ticket'] = Tickets::find($id);
        $edit['user'] = User::all();
        $edit['equipment'] = Equipment::all();
        return view('serviceorders.edit',$edit);
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
            'user_sign' => 'required|string',
            'specialist_sign' => 'required|string',
        ]);

        $order = ServiceOrders::find($id);
        $order->status = 2;

        $ticket = Tickets::find($id);
        $ticket->status = 2;
        $ticket->save();

        $order->update($data);
        return redirect()->route('orders.index')->with('success', 'Orden finalizada correctamente, ya puedes descargarla.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    public function reportes_pdf(){
        // $this->availibility('View orders');
        $pdf['page'] = 'Orders';
        $pdf['orders'] = ServiceOrders::all();
        $pdf = PDF::loadView('serviceorders.serviceorders_pdf',$pdf);
        return $pdf->download(time() . '_orders.pdf');
    }

    //reporte para pdf individual
    public function pdf($id){
        // $this->availibility('View orders');
        $pdf['page'] = 'Orders';
        $pdf['order'] = ServiceOrders::find($id);
        $pdf = PDF::loadView('serviceorders.order_pdf',$pdf);
        return $pdf->download('order'.$id.'.pdf');
    }


    public function updateStatus($id)
    {
        $order = ServiceOrders::find($id);
        $order->status = 2;
        $ticket = Tickets::find($id);
        $ticket->status = 2;
        $ticket->save();
        $order->save();
        return redirect()->route('orders.index')->with('success', 'El estado de la orden ha sido actualizado correctamente.');
    }
}

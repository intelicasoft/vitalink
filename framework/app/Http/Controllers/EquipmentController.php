<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Excel;
use QrCode;
use App\Hospital;
use App\CallEntry;
use App\Equipment;
use App\Department;
use App\Calibration;
use Illuminate\Http\Request;
// use App\Role;
use Spaite\Permission\Role;
use Illuminate\Support\Collection;
use App\Http\Requests\EquipmentRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

// use Maatwebsite\Excel\Facades\Excel;
class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        set_time_limit(0);
        $this->availibility('View Equipments');
        $index['page'] = 'equipments';
        //$index['equipments'] = Equipment::latest()->get();
        $index['hospitals'] = Hospital::all();
        $index['companies'] = Equipment::distinct()->get(['company']);
        $index['hospital_id'] = isset($request->hospital_id) ? $request->hospital_id : "";
        $index['companyy'] = isset($request->company) ? $request->company : "";

        $equipments = Equipment::select('*');
        if (isset($index['hospital_id']) && $index['hospital_id'] != "") {
            $equipments->where('hospital_id', $index['hospital_id']);
        }
        if (isset($index['companyy']) && $index['companyy'] != "") {
            $equipments->where('company', $index['companyy']);
        }
        if (isset($request->excel_hidden)) {
            $equipments = $equipments->latest()->get();
            $updatedEquipments = [];
             foreach($equipments as $equipment){
                $equipment->date_of_purchase = date_change($equipment->date_of_purchase);
                $equipment->order_date = date_change($equipment->order_date);
                $equipment->date_of_installation = date_change($equipment->date_of_installation);
                $equipment->warranty_due_date = date_change($equipment->warranty_due_date);
                $updatedEquipments[] = $equipment;
             }
             $equipments = collect($updatedEquipments);
            // return Excel::store(time() . '_equipment', function ($excel) use ($equipments) {
            //     $excel->sheet('sheet1', function ($sheet) use ($equipments) {
            //         $sheet->loadView('equipments.export_excel')
            //             ->with('equipments', $equipments);
            //     });
            // })->download('xlsx');
            return Excel::download(new class ($equipments) implements FromCollection {
                public function __construct($collection)
                {
                    $this->collection = $collection;
                }
                public function collection()
                {
                    return $this->collection;
                }
            }, time() . '_equipment.xlsx');
        } elseif (isset($request->pdf_hidden)) {

            $equipments = $equipments->latest()->get();
            //dd($equipments);
            $pdf = PDF::loadView('equipments.export_pdf', ['equipments' => $equipments])->setPaper('a4', 'landscape');
            return $pdf->download(time() . '_equipment.pdf');
        } else {
            $index['equipments'] = $equipments->latest()->get();
        }
        return view('equipments.index', $index);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->availibility('Create Equipments');
        $index['page'] = 'equipments';
        $index['hospitals'] = Hospital::all();
        $index['departments'] =
            Department::select('id', DB::raw('CONCAT(short_name," (" , name ,")") as full_name'))
                ->pluck('full_name', 'id')
                ->toArray();
        return view('equipments.create', $index);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        $equipment = new Equipment;
        $equipment->name = trim($request->name);
        $equipment->short_name = $request->short_name;
        $equipment->user_id = \Auth::user()->id;
        $equipment->company = $request->company;
        $equipment->sr_no = $request->sr_no;
        $equipment->hospital_id = $request->hospital_id;
        $equipment->department = $request->department;
        $equipment->model = $request->model;
        $date_of_purchase = !empty($request->date_of_purchase) ? date('Y-m-d', strtotime($request->date_of_purchase)) : null;
        $order_date = !empty($request->order_date) ? date('Y-m-d', strtotime($request->order_date)) : null;
        $date_of_installation = !empty($request->date_of_installation) ? date('Y-m-d', strtotime($request->date_of_installation)) : null;
        $warranty_due_date = !empty($request->warranty_due_date) ? date('Y-m-d', strtotime($request->warranty_due_date)) : null;

        $equipment->date_of_purchase = $date_of_purchase;
        $equipment->order_date = $order_date;
        $equipment->date_of_installation = $date_of_installation;
        $equipment->warranty_due_date = $warranty_due_date;
        $equipment->service_engineer_no = $request->service_engineer_no;
        $equipment->is_critical = $request->is_critical;
        $equipment->notes = $request->notes;
        $equipment_number = Equipment::where('hospital_id', $request->hospital_id)
            ->where('name', trim($request->name))
            ->where('short_name', $request->short_name)
            ->where('department', $request->department)
            ->count();
        $equipment_number = sprintf("%02d", $equipment_number + 1);

        $equipment->unique_id = "";
        $hospital = Hospital::where('id', $request->hospital_id)->first();
        if ($hospital != "") {
            $unique_id = $hospital->slug . '/' . $equipment->department . '/' . $equipment->short_name . '/' . $equipment_number;

            $equipment->unique_id = $unique_id;
        }
        $equipment->save();
        $id = $equipment->id;
        if (extension_loaded('imagick')) {
            // Generate QR Code
            $url = url('/') . "/equipments/history/" . $id;
            $image = QrCode::format('png')->size(300)->generate($url, 'uploads/qrcodes/' . $id . '.png');
        }

        return redirect('admin/equipments')->with('flash_message', 'Equipment "' . $equipment->name . '" created');
    }

    public function regenerate_all_qr()
    {
        set_time_limit(0);
        $equipments = Equipment::all();
        foreach ($equipments as $key => $equipment) {
            $id = $equipment->id;
            if (extension_loaded('imagick')) {
                // Generate QR Code
                $url = url('/') . "/equipments/history/" . $id;
                $image = QrCode::format('png')->size(300)->generate($url, 'uploads/qrcodes/' . $id . '.png');
            }
        }
        echo "QRs regenerated!";
    }

    public function qr($id)
    {
        $equipment = Equipment::findOrFail($id);
        $url = url('/') . "/admin/equipments/history/" . $equipment->id;
        $qr_content = __('equicare.equipment_id') . ": " . $equipment->unique_id . " \n\n" .
            __('equicare.details') . ": " . $url;
        return '<div style="text-align:center;"><img src="data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(150)->generate($qr_content)) . '"></div>';
    }

    public function qr_image($id)
    {
        $equipment = Equipment::findOrFail($id);
        $url = url('/') . "/admin/equipments/history/" . $equipment->id;
        $qr_content = __('equicare.equipment_id') . ": " . $equipment->unique_id . " \n\n" .
            __('equicare.details') . ": " . $url;
        $image = QrCode::format('png')->size(150)->generate($qr_content);
        return response($image)->header('Content-type', 'image/png');
    }

    public function edit($id)
    {
        $this->availibility('Edit Equipments');
        $index['page'] = 'equipments';
        $index['equipment'] = Equipment::findOrFail($id);
        $index['hospitals'] = Hospital::all();
        $index['departments'] =
            Department::select('id', DB::raw('CONCAT(short_name," (" , name ,")") as full_name'))
                ->pluck('full_name', 'id')
                ->toArray();
        return view('equipments.edit', $index);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\quipments  $quipments
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->name = trim($request->name);
        $equipment->short_name = $request->short_name;
        $equipment->user_id = \Auth::user()->id;
        $equipment->company = $request->company;
        $equipment->sr_no = $request->sr_no;
        $equipment->hospital_id = $request->hospital_id;
        $equipment->department = $request->department;
        $equipment->model = $request->model;
        $date_of_purchase = !empty($request->date_of_purchase) ? date('Y-m-d', strtotime($request->date_of_purchase)) : null;
        $order_date = !empty($request->order_date) ? date('Y-m-d', strtotime($request->order_date)) : null;
        $date_of_installation = !empty($request->date_of_installation) ? date('Y-m-d', strtotime($request->date_of_installation)) : null;
        $warranty_due_date = !empty($request->warranty_due_date) ? date('Y-m-d', strtotime($request->warranty_due_date)) : null;

        $equipment->date_of_purchase = $date_of_purchase;
        $equipment->order_date = $order_date;
        $equipment->date_of_installation = $date_of_installation;
        $equipment->warranty_due_date = $warranty_due_date;
        $equipment->service_engineer_no = $request->service_engineer_no;
        $equipment->is_critical = $request->is_critical;
        $equipment->notes = $request->notes;

        $equipment->save();
        if (extension_loaded('imagick')) {
            // Generate QR Code
            $url = url('/') . "/equipments/history/" . $id;
            $image = QrCode::format('png')->size(300)->generate($url, 'uploads/qrcodes/' . $id . '.png');
        }

        return redirect('admin/equipments')->with('flash_message', 'Equipment "' . $equipment->name . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\quipments  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->availibility('Delete Equipments');
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return redirect('admin/equipments')->with('flash_message', 'Equipment "' . $equipment->name . '" deleted');
    }

    public static function availibility($method)
    {

        $r_p = \Auth::user()->getPermissionsViaRoles()->pluck('name')->toArray();

        if (\Auth::user()->hasPermissionTo($method)) {

            return true;
        } elseif (!in_array($method, $r_p)) {
            abort('401');
        } else {
            return true;
        }
    }

    public function history($id)
    {
        $index['page'] = 'equipments history';
        $index['equipment'] = Equipment::find($id);

        $history = collect();
        $h1 = CallEntry::where('equip_id', $id)->with('user')->with('user_attended_fn')->get();
        foreach ($h1 as $h) {
            $h2 = collect($h);
            $h2->put('type', 'Call');
            $history[] = $h2;
        }

        $calibration = collect();
        $c1 = Calibration::where('equip_id', $id)->with('user')->get();
        foreach ($c1 as $c) {
            $c2 = collect($c);
            $c2->put('type', 'Calibration');
            $calibration[] = $c2;
        }

        $collection = new Collection();
        $index['data'] = $collection->merge($history)->merge($calibration)->sortByDesc('created_at');

        return view('equipments.history', $index);
    }
}
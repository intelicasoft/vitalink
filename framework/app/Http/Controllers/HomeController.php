<?php

namespace App\Http\Controllers;

use App\CallEntry;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$index['page'] = '/home';

		$last_thirty_days = date('Y-m-d', strtotime('-30 days'));

		// $preventive = CallEntry::select('*', DB::raw('COUNT(*) as total'), DB::raw('DATE(call_entries.created_at) as date'))
		//     ->where('call_type', 'preventive')
		//     ->whereDate('call_entries.created_at', '>=', $last_thirty_days)
		//     ->Hospital()
		//     ->groupBy('call_entries.created_at')
		//     ->get();

		$reviewsPerUserThisMonth = \App\Models\Reviews::select(\DB::raw('users.name as user_name, COUNT(*) as total_reviews'))
			->join('users', 'reviews.user_id', '=', 'users.id')
			->whereYear('reviews.created_at', date('Y'))
			->whereMonth('reviews.created_at', date('m'))
			->groupBy('users.name')
			->get();

		$reviewsPerUserYesterday = \App\Models\Reviews::select(\DB::raw('users.name as user_name, COUNT(*) as total_reviews'))
			->join('users', 'reviews.user_id', '=', 'users.id')
			->whereDate('reviews.created_at', \Carbon\Carbon::yesterday())
			->groupBy('users.name')
			->get();

		$ticketsClosedIn72HoursPerMonth = \App\Models\Tickets::select(
			\DB::raw('YEAR(updated_at) as year'),
			\DB::raw('MONTH(updated_at) as month'),
			\DB::raw('COUNT(*) as total_tickets')
		)
			->where('status', 2)
			->where(\DB::raw('TIMESTAMPDIFF(HOUR, created_at, updated_at)'), '<=', 72)
			->groupBy('year', 'month')
			->get();

		$ticketsClosedPerMonth = \App\Models\Tickets::select(
			\DB::raw('YEAR(updated_at) as year'),
			\DB::raw('MONTH(updated_at) as month'),
			\DB::raw('COUNT(*) as total_tickets')
		)
			->where('status', 2)
			->groupBy('year', 'month')
			->get();

		$equipmentStatusCounts = \App\Equipment::select(\DB::raw("
			CASE
				WHEN status = 1 THEN 'Disponible, en uso'
				WHEN status = 2 THEN 'Disponible, sin uso'
				WHEN status = 3 THEN 'Fuera de servicio, reportado'
				WHEN status = 4 THEN 'Fuera de servicio, No reportado'
				ELSE 'No registrado'
			END as status_description,
			COUNT(*) as total
		"))
			->groupBy('status_description')
			->get();

		for ($i = 30; $i >= 0; $i--) {
			$total_days[] = date("Y-m-d", strtotime('-' . $i . ' days'));
		}


		$index['ticketsClosedIn72HoursPerMonth'] = $ticketsClosedIn72HoursPerMonth;
		$index['ticketsClosedPerMonth'] = $ticketsClosedPerMonth;
		$index['reviewsPerUserThisMonth'] = $reviewsPerUserThisMonth;
		$index['reviewsPerUserYesterday'] = $reviewsPerUserYesterday;
		$index['total_days_array'] = $total_days;
		$index['equipmentStatusCounts'] = $equipmentStatusCounts;
		// dd($index);
		return view('home', $index);
	}
}

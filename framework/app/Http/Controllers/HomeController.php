<?php

namespace App\Http\Controllers;

use App\CallEntry;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$index['page'] = '/home';
		$breakdown_totals = $preventive_totals = $total_days = [];

		$last_thirty_days = date('Y-m-d', strtotime('-30 days'));

		// $breakdown = CallEntry::select('*', DB::raw('COUNT(*) as total'), DB::raw('DATE(created_at) as date'))
		// 	->where('call_type', 'breakdown')
		// 	->whereDate('created_at', '>=', $last_thirty_days)->Hospital()
		// 	->groupBy('date')->get();

		// $preventive = CallEntry::select('*', DB::raw('COUNT(*) as total'), DB::raw('DATE(created_at) as date'))
		// 	->where('call_type', 'preventive')
		// 	->whereDate('created_at', '>=', $last_thirty_days)->Hospital()
		// 	->groupBy('date')->get();
		$breakdown = CallEntry::select('*', DB::raw('COUNT(*) as total'), DB::raw('DATE(call_entries.created_at) as date'))
		    ->where('call_type', 'breakdown')
		    ->whereDate('call_entries.created_at', '>=', $last_thirty_days)
		    ->Hospital()
		    ->groupBy('call_entries.created_at')
		    ->get();

		$preventive = CallEntry::select('*', DB::raw('COUNT(*) as total'), DB::raw('DATE(call_entries.created_at) as date'))
		    ->where('call_type', 'preventive')
		    ->whereDate('call_entries.created_at', '>=', $last_thirty_days)
		    ->Hospital()
		    ->groupBy('call_entries.created_at')
		    ->get();

		$reviewsPerUserThisMonth = \App\Models\Reviews::select(\DB::raw('user_id, COUNT(*) as total_reviews'))
			->whereYear('created_at', date('Y'))
			->whereMonth('created_at', date('m'))
			->groupBy('user_id')
			->get();

		$reviewsPerUserYesterday = \App\Models\Reviews::select(\DB::raw('user_id, COUNT(*) as total_reviews'))
			->whereDate('created_at', \Carbon\Carbon::yesterday())
			->groupBy('user_id')
			->get();

		$ticketsClosedIn72HoursPerMonth = \App\Models\Tickets::select(\DB::raw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as total_tickets'))
			->where('status', 2)
			->where(\DB::raw('TIMESTAMPDIFF(HOUR, created_at, updated_at)'), '<=', 72)
			->groupBy('year', 'month')
			->get();
		
		$ticketsClosedPerMonth = \App\Models\Tickets::select(\DB::raw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as total_tickets'))
			->where('status', 2)
			->groupBy('year', 'month')
			->get();

		for ($i = 30; $i >= 0; $i--) {
			$total_days[] = date("Y-m-d", strtotime('-' . $i . ' days'));
		}

		foreach ($total_days as $key => $v) {
			foreach ($breakdown as $key => $b) {
				if ($b->date == $v) {
					array_push($breakdown_totals, $b->total);
				} else {
					array_push($breakdown_totals, 0);
				}
			}

			foreach ($preventive as $key => $p) {
				if ($p->date == $v) {
					array_push($preventive_totals, $p->total);
				} else {
					array_push($preventive_totals, 0);
				}
			}
		}
		$index['ticketsClosedIn72HoursPerMonth'] = $ticketsClosedIn72HoursPerMonth;
		$index['ticketsClosedPerMonth'] = $ticketsClosedPerMonth;
		$index['reviewsPerUserThisMonth'] = $reviewsPerUserThisMonth;
		$index['reviewsPerUserYesterday'] = $reviewsPerUserYesterday;
		$index['total_days_array'] = $total_days;
		$index['breakdown'] = $breakdown_totals;
		$index['preventive'] = $preventive_totals;
		// dd($index);
		return view('home', $index);
	}

}

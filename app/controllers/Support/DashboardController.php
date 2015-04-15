<?php

class DashboardController extends BaseController {

	public $restful	= true;

	/**
	* Shows the dashboard
	*
	* @return	View
	* @access	public
	*/
	public function index() {
		if (Session::get('role') < 3) {
			return $this->loadAdminDashboard();
		} else {
			return $this->loadUserDashboard();
		}
	}

	/**
	* Sets a cookie so the alerts won't show up again
	*
	* @return	json
	* @access	public
	*/
	public function postHideAlerts() {
		$hide = Input::get('hide');

		if (!empty($hide)) {
			$hash = md5(Setting::where_name('system_message')->first()->value);
			Cookie::forever('hide-alert', $hash);
		}

		return Response::json(array('success' => true));
	}

	/**
	* Generates data for a "tickets in the last 7 days" graph
	*
	* @return	object	- days, tickets per day and total tickets in week in json format
	* @access	private
	*/
	private function chartWeeklyTickets() {
		// chart: tickets this week
		$week = new StdClass;
		
		// get current day and the 7 days before, then turn them into an array
		define('DAY_SECS', 86400);
		$days[]	= date('l');

		// get the 6 prior days of today
		for ($x = 1; $x <= 6; $x++) {
			$days[] = date('l', time() - (DAY_SECS * $x));
		}

		$days				= array_reverse($days);
		$days_translation	= array(
			'Monday'	=> 'Lunes',
			'Tuesday'	=> 'Martes',
			'Wednesday'	=> 'Miércoles',
			'Thursday'	=> 'Jueves',
			'Friday'	=> 'Viernes',
			'Saturday'	=> 'Sábado',
			'Sunday'	=> 'Domingo'
		);

		foreach ($days as &$d) {
			$d = $days_translation[$d];
		}

		$week->days	= json_encode($days);

		// now, get the 7 day ticket count
		$max = time();
		$min = time() - (DAY_SECS * 6);
		
		$bindings		= array(Helper::sqltime($min), Helper::sqltime($max));
		$week->count	= DB::statement('SELECT COUNT(`id`) as `total` FROM tickets WHERE created_at BETWEEN ? AND ? LIMIT 1', $bindings); 

		$date = Helper::sqltime($min);

		for ($x = 1; $x <= 7; $x++) {
			$bindings		= array($date, $date);
			$day_tickets[]	= DB::select('SELECT COUNT(`id`) as `total` FROM tickets WHERE created_at BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY) LIMIT 1', $bindings);
			$date			= Helper::sqltime($min + (DAY_SECS * $x));
		}

		$week->tickets = json_encode($day_tickets, JSON_NUMERIC_CHECK);

		return $week;
	}

	/**
	* Generates the data for a "total tickets per user" graph
	*
	* @return	object	- users and the amount of tickets they've made in json format
	* @access	private
	*/
	private function chartTotalTickets() {
		$tickets		= new StdClass;
		$tickets->users	= User::all(); 

		foreach($tickets->users as $user) {
			$ticket_amount	= Ticket::where('reported_by', '=', Auth::user()->getId())->count(); 

			if (!empty($ticket_amount)) {
				$json_tickets[]	= $ticket_amount;
				$json_users[]	= $user->firstname;
			}
		}

		$tickets->users = json_encode($json_users);
		$tickets->total = json_encode($json_tickets, JSON_NUMERIC_CHECK);

		return $tickets;
	}

	/**
	* Generates all the information for the admin dashboard
	*
	* @return	View
	* @access	private
	*/
	private function loadAdminDashboard() {
		// add required assets
		

		// prevent errors creating default objects
		$assigned	= new StdClass;
		$latest		= new StdClass;
		$total		= new StdClass;

		// tickets
		$assigned->tickets	= Ticket::where('assigned_to', '=', Auth::user()->getId())->where('status', '<>', 'closed')->take(13)->orderBy('id', 'desc')->get();
		$latest->tickets	= Ticket::take(13)->orderBy('id', 'desc')->get();

		// stats
		$assigned->open		= Ticket::where('assigned_to', '=', Auth::user()->getId())->where('status','=','open')->count();
		$assigned->all		= Ticket::where('assigned_to', '=', Auth::user()->getId())->count();
		$assigned->total	= count($assigned->tickets);
		$total->amount		= Ticket::count();
		$total->open		= Ticket::where('status','=','open')->count();

		$tickets	= $this->chartTotalTickets();
		$week		= $this->chartWeeklyTickets();

		// system messages
		// this will have a md5 hash of the message or null
		$show	= true;
		$alert	= Cookie::get('hide-alert');

		// if there's data, check if the data is the same as the message
		$hash				= $alert;
		$alert				= new StdClass;
		$alert->message		= Setting::where('name','=','system_message')->first()->value;
		$alert->title		= Setting::where('name','=','system_message_title')->first()->value;
		
		// there's a message? the message can't match the cookie for it to show
		if ($alert->message) {
			if (md5($alert->message) != $hash) {
				$show = true;
			} else {
				$show = false;
			}
		} else {
			$show = false;
		}
		
		// what badge should we display in assigned?
		if ($assigned->total == 0): $badge = 'success'; else: $badge = 'important'; endif;

		// load markdown
		Load::library('markdown/markdown');

		return View::make('support.dashboard.index')
				->with(array('assigned' => $assigned, 'latest' => $latest, 'total' => $total, 'tickets'=> $tickets,'week'=> $week, 
                                    'badge' => $badge, 'alert' => $alert, 'show' => $show, 'title' => 'Dashboard'));
				

	}

	/**
	* Generates all the information for the user dashboard
	*
	* @return	View
	* @access	private
	*/
	private function loadUserDashboard() {
		return Redirect::route('tickets/mine');
	}
}
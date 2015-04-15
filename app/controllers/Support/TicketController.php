<?php

/**
* Handles ticket CRUD and other methods.
*/
class TicketController extends BaseController {


    
    
	public $restful = true;

	/**
	* Shows the add ticket form
	*
	* @access	public
	*/
	public function getAdd() {
		Load::markdown();

		return View::make('support.ticket.add')
			->with('title', 'New Ticket');
	}

	/**
	* Shows only logged-in user tickets
	*
	* @param	string	- the status or id filter
	* @return	View
	* @access	public
	*/
	public function getMine($search = null) {
		$tickets = Ticket::where('reported_by',Session::get('id'));
		$this->searchTickets($search, $tickets);
		$tickets = $tickets->orderBy('id', 'desc')->paginate(Setting::where('name','per_page')->first()->value);

		$users = User::all();

		return View::make('support.ticket.all')
			->with('title', 'My Tickets')
			->with('tickets', $tickets)
			->with('users', $users)
			->with('url', 'support/tickets/mine/');
	}

	/**
	* Shows only tickets assigned to the logged-in user
	*
	* @param	string	- the status or id filter
	* @return	View
	* @access	public
	*/
	public function getAssigned($search = null) {
		$tickets = Ticket::where('assigned_to','=',Session::get('id'));
		$this->searchTickets($search, $tickets);
		$tickets = $tickets->orderBy('id', 'desc')->paginate(Setting::where('name','per_page')->first()->value);

		$users = User::all();

		return View::make('support.ticket.all')
			->with('title', 'Tickets asignadas')
			->with('tickets', $tickets)
			->with('users', $users)
			->with('url', 'support/tickets/assigned/');
	}

	/**
	* Shows detailed information about a ticket
	*
	* @param	int		- the ticket id
	* @access	public
	*/
	public function getView($ticket) {
		$ticket = Ticket::find($ticket);

		// if normal user and not his ticket, redirect
		if (Session::get('role') == 3 && 
                        $ticket->reported_by != Session::get('id')) {
			return Redirect::to('support');
		}

		$messages	= $ticket->messages()->get();

		// ticket details
                if (isset($ticket->reported_by) || $ticket->reported_by == 0){
		$reporter				= User::find($ticket->reported_by);
		$reporter->fullname                     = $reporter->firstname . ' ' . $reporter->lastname;
                }
                else { $reporter->fullname = ''; }
		$department				= Department::find($ticket->department);
		$assigned				= User::find($ticket->assigned_to);

		// markdown enabled view
		Load::markdown();

		return View::make('support.ticket.view')
			->with('ticket', $ticket)
			->with('messages', $messages)
			->with('reporter', $reporter)
			->with('assigned', $assigned)
			->with('department', $department)
			->with('title', 'Inquiry #' . $ticket->id . ': ' . $ticket->subject);
	}

	/**
	* Shows all tickets
	*
	* @access	public
	*/
	public function getAll($search = null) {
		$tickets	= Ticket::orderBy('id', 'desc');
		$this->searchTickets($search, $tickets);
		$tickets	= $tickets->paginate(Setting::where('name', 'per_page')->first()->value);
		$users		= User::all();

		return View::make('support.ticket.all')
			->with('tickets', $tickets)
			->with('users', $users)
			->with('title', 'All Tickets')
			->with('url', 'support/tickets/');
	}

	/**
	* Adds a new ticket
	*
	* @access	public
	*/
	public function postAdd() {
		$input	= array(
			'department'	=> Input::get('department'),
			'subject'		=> Input::get('subject'),
			'content'		=> Input::get('content')
		); 

		// only support and admins can set an assigned person
		if (Input::get('assign')) {
			$input['assigned_to'] = Input::get('assign');
		}

		$rules = array(
			'department'	=> 'required',
			'subject'		=> 'required',
			'content'		=> 'required'
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Redirect::to('support/ticket/add')->with('notification', 'form_required');
		}

		// validation passed, prepare data to be added to database
		$ticket = array(
			'subject'		=> $input['subject'],
			'content'		=> $input['content'],
			'department'            => $input['department'],
			'reported_by'           => Auth::user()->getId(),
		);

		if (isset($input['assigned_to'])) {
			$ticket['assigned_to']	= $input['assigned_to'];
		}

		// notify only the assigned person or the whole department
		if (isset($input['assigned_to'])) {
			$members	= User::where('id','=',$input['assigned_to'])->get(array('firstname', 'lastname', 'email'));
		} else {
			$members	= Department::find($input['department'])->user()->where('status','active')->get('firstname', 'lastname', 'email');
		}
		

		// save it to the database
		$ticket		= Ticket::create($ticket);

		// all good
		return View::make('support.ticket.success')->with('ticket', $ticket)->with('title', '¡Ticket Created!');
	}

	/**
	* Adds a new message to a ticket
	*
	* @param	int		- the ticket id
	* @access	public
	*/
	public function postUpdate($ticket) {
		$data = array(
			'user_id'	=> Auth::user()->getId(),
			'content'	=> Input::get('content')
		);
		
		// save the status of the update
		$message		= Message::add($ticket, $data);
		$redirect	= Redirect::to('support/ticket/' . $ticket);
		$ticket		= Ticket::find($ticket);
		$status		= Input::get('status');
		$department = Input::get('department');
		$assign_to	= Input::get('assign');

		// set a new department if it was changed
		if (!empty($department)) {	
			$ticket->department = $department;
		}

		if (!empty($status)) {
			$ticket->status = $status;
		}

		if ($message === 'validation_failed') {
			return $redirect->with('notification', 'form_required');

		// database error — this should NEVER happen
		} elseif ($message === false) {
			return $redirect->with('notification', 'message_add_failed');
		}


		// who replied to the ticket
		$replier = User::find($data['user_id']);
		$replier->fullname = $replier->firstname . ' ' . $replier->lastname;

		// who made the ticket
		$reporter = User::find($ticket->reported_by);
		$reporter->fullname = $reporter->firstname . ' ' . $reporter->lastname;


		if (!empty($assign_to)) {
		
			$assigned = User::find($assign_to);
			// and update the assigned person
			$ticket->assigned_to = $assign_to;
		}

		// save changes
		$ticket->save();
		
		

		return $redirect->with('notification', 'message_add_success');
	}

	/**
	* Changes the ticket status
	*
	* @param	int		- the ticket id
	* @access	public
	*/
	public function putStatus($ticket) {
		$redirect		= Redirect::to('support/ticket/' . $ticket);
		$ticket			= Ticket::find($ticket);
		$ticket->status	= Input::get('status');
		$ticket->save();

		return $redirect->with('notification', 'ticket_status_changed');
	}

	/**
	* Searches for specific tickets
	*
	* @return	Redirect
	* @access	public
	*/
	public function putSearch() {
		$value	= Input::get('value');
		$url	= Input::get('url');

		if (is_numeric($value)) {
			return Redirect::to($url . $value);
		} else {
			return Redirect::to($url);
		}
	}

	/**
	* Gets a search parameter and appends it to the query
	*
	* @param	mixed   $search     Could be a ticket or a status
	* @param	int     $ticket
	* @return	Laravel Query
	* @access	public
	*/
	private function searchTickets($search,  $tickets) {
		if (!empty($search)) {

			// search either by id or by status
			if (is_numeric($search)) {
				return $tickets->where('id',$search);
			} elseif ($search == 'mine') {
                                return $tickets->where('reported_by',Session::get('id'));
                        } else {
				return $tickets->where('status', $search);
			}
		}
	}

}

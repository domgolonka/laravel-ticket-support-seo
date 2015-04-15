<p>{{ HTML::mailto($from->email, $from->firstname . ' ' . $from->lastname) }} has created a new ticket:</p>

<blockquote>

    <h4>{{ HTML::link('support/ticket/' . $ticket->id, $ticket->subject) }}</h4>

    <p>{{ $content }}</p>

</blockquote>

<p>To access the ticket, go to the following address: {{ HTML::link('support/ticket/' . $ticket->id); }}</p>
<p>{{ HTML::mailto($from->email, $from->firstname . ' ' . $from->lastname) }} updated the ticket { HTML::link('support/ticket/' . $ticket->id, $ticket->subject) }}:</p>

<blockquote>

    <p>{{ $content }}</p>

</blockquote>

<p>To access the ticket, go to the following address: {{ HTML::link('support/ticket/' . $ticket->id) }}</p>
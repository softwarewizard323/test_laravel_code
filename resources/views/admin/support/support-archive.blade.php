@extends('admin.layouts.app')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="msgView_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-inbox"></i><h5>Archived User Tickets</h5>
                    <a href="{{ url('/admin/support') }}" class="btn btn-success pull-right" style="margin: 10px 15px 0 0;color:#FFF;">
                        <i class="icon-book"></i> View Open Tickets
                    </a>
                </div>
                <div class="widget-body">
                    <table class="table table-hover" data-provides="rowlink">
                        <form id="tickets" method="post" action="{{url('/admin/support/ticket/delete')}}">{{ csrf_field() }}</form>
                        <tbody>
                        @if ($tickets->count() !=0)
                            @foreach($tickets as $ticket)
                                    <tr @if (isset($ticket->adminTicketStatus) and $ticket->adminTicketStatus->ticket_status == 0)
                                            style="background: #F5F5F5; font-weight: bold;" @endif >
                                        <td>
                                            <input type="checkbox" name="checkbox[]" id="checkbox[]" value="{{ $ticket->ticket_id }} " form="tickets">
                                        </td>
                                        <td width="110">
                                            Ticket #{{ $ticket->ticket_id }}
                                        </td>
                                        <td>
                                            {{ $ticket->userUsername }}
                                        </td>
                                        <td>
                                            @if( $ticket->ticket_status == '1')
                                                <span class="label label-success">Active</span>
                                            @else <span class="label label-warning">Solved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ticket->ticket_priority == '1')
                                                <span class="label label-important">High Priority</span>
                                            @elseif ($ticket->ticket_priority  == '2')
                                                <span class="label label-success">Medium Priority</span>
                                            @else<span class="label label-info">Low Priority</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($ticket->replies) and $ticket->replies->count() > 0 )
                                                <span class='badge'>{{ $ticket->replies->count() }}</span>
                                            @endif
                                            <a href="{{url('/admin/support/ticket',['id' =>$ticket->ticket_id ])}}">
                                                @if ($ticket->ticket_title == '')
                                                    'Please help me with this problem'
                                                @else
                                                    {{ str_replace("\\","",$ticket->ticket_title) }}</a>
                                            @endif
                                            @if ($ticket->ticket_orderID > 0)
                                                Order #{{ $ticket->ticket_orderID }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ticket->avgRating && $ticket->avgRating->count_rating > 0)
                                                <?php $avgTicketStar = $ticket->avgRating->sum_value / $ticket->avgRating->count_rating; ?>
                                                @if ( round($avgTicketStar) == 1 ) <img src="/include/img/1-star.gif" title="Bad" /> @endif
                                                @if ( round($avgTicketStar) == 2 ) <img src="/include/img/2-star.gif" title="Good" /> @endif
                                                @if ( round($avgTicketStar) == 3 ) <img src="/include/img/3-star.gif" title="Very good" /> @endif
                                                @if ( round($avgTicketStar) == 4 ) <img src="/include/img/4-star.gif" title="Superior" /> @endif
                                                @if ( round($avgTicketStar) == 5 ) <img src="/include/img/5-star.gif" title="Exceptional" /> @endif
                                            @endif
                                        </td>
                                        <td width="95" style="text-align:right;">
                                            <?php
                                            //Format the date for each ticket
                                            $sqldate = strtotime($ticket->ticket_date);
                                            $ticketDate = date('d-m-Y', $sqldate);
                                            $currentDate = date('d-m-Y', time()); //Todays date
                                            ?>
                                            <time>{{ ($ticketDate  == $currentDate)?'Today' : ''.$ticketDate .'' }}</time>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <div style="margin: 50px; font-size: 19px; color: #999; text-align: center;">No Active or Closed tickets.</div>
                                @endif
                        </tbody>
                    </table>
                </div>

                <div class="widget-footer">
                    <div class="pull-left">
                         <p class="muted" style="margin: 5px">Showing {{ $tickets->count() }} of {{ $tickets->count() }}</p>
                    </div>
                    <div class="pull-right">
                        @if ($tickets)
                        <button id="delete" class="btn" type="submit" name="delete" value="Delete Selected Ticket" form="tickets"
                                onclick="return confirm('Are you sure want to delete these ticket(s)');">
                            <i class="icon-trash"></i> Delete
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
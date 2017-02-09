@extends('dashboard.layouts.app')

@section('title', ' - Support')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgView_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-inbox"></i><h5>My Tickets</h5>
                    @if ($tickets->count() > 0)
                    <div class="widget-buttons">
                        <div class="dropdown">
                            <a class="dropdown-toggle btn btn-info" style="margin:-5px 0 0 0; color: #FFF;" id="drop4" role="button" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> Create New Ticket</a>
                            <ul id="menu1" class="dropdown-menu pull-right" role="menu" aria-labelledby="drop4">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/support/new', ['type' => 'cosmetic']) }}">for Cosmetic Traffic</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/support/new', ['type' => 'conversion']) }}">for Conversion Traffic</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/support/new', ['type' => 'other']) }}">for Other</a></li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="widget-body">
                    <table class="table table-hover" data-provides="rowlink">
                        <tbody>
                        @foreach($tickets as $ticket)
                        <tr @if ($ticket->userTicketStatus && $ticket->userTicketStatus->ticket_status == 0) style="background: #F5F5F5; font-weight: bold;" @endif>
                            <td>
                                Ticket #{{ $ticket['ticket_id'] }}
                            </td>
                            <td>
                                @if ($ticket['ticket_status'] == '1') <span class="label label-success">Active</span> @else <span class="label label-warning">Closed</span> @endif
                            </td>
                            <td>
                                @if ($ticket['ticket_priority'] == '1') <span class="label label-important">High Priority</span> @elseif ($ticket['ticket_priority'] == '2') <span class="label label-success">Medium Priority</span> @else <span class="label label-info">Low Priority</span> @endif
                            </td>
                            <td>
                                @if ($ticket->replies()->count() > 0) <span class="badge">{{ $ticket->replies->count() }}</span> @endif

                                <a href="{{ url('/dashboard/support/view', ['id' => $ticket['ticket_id']]) }}">@if ($ticket['ticket_title'] == '') Please help me with this problem @else {{ str_replace("\\","",$ticket['ticket_title']) }} @endif</a>
                                @if ($ticket['ticket_orderID'] > 0) / Order #{{ $ticket['ticket_orderID'] }}@endif
                            </td>
                            <td>
                                @if ($ticket->avgRating && $ticket->avgRating->count_rating > 0)
                                    <center>
                                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 1 ) {{ Html::image('include/img/1-star.gif', null, ['title' => 'Bad']) }} @endif
                                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 2 ) {{ Html::image('include/img/2-star.gif', null, ['title' => 'Good']) }} @endif
                                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 3 ) {{ Html::image('include/img/3-star.gif', null, ['title' => 'Very good']) }} @endif
                                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 4 ) {{ Html::image('include/img/4-star.gif', null, ['title' => 'Superior']) }} @endif
                                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 5 ) {{ Html::image('include/img/5-star.gif', null, ['title' => 'Exceptional']) }} @endif
                                    </center>
                                @endif
                            </td>
                            <td>
                                @if($ticket->replay)
                                <time>{{ \App\Models\Domain\Dashboard::ev_timestamp($ticket->replay->ticket_replay_date) }}</time>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @if ($tickets->count() == 0)
                        <div style="margin: 50px auto 20px auto; font-size: 19px; color: #999; text-align: center;">No Active or Closed tickets.</div>
                        <div class="dropdown span2" style="margin:15px 0 90px 46.5%;">
                            <a class="dropdown-toggle btn btn-info" id="drop4" role="button" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> Create New Ticket</a>
                            <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/support/new', ['type' => 'cosmetic']) }}">for Cosmetic Traffic</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/support/new', ['type' => 'conversion']) }}">for Conversion Traffic</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/dashboard/support/new', ['type' => 'other']) }}">for Other</a></li>
                            </ul>
                        </div>
                        @endif

                        </tbody>
                    </table>
                </div>

                <div class="widget-footer">
                    <div class="pull-left">
                        <p class="muted" style="margin: 5px">Showing {{ $tickets->count() }} of {{ $tickets->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

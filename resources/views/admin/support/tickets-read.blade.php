@extends('admin.layouts.app')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="msgRead_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10">
                <div class="widget-header">
                    <i class="icon-ticket"></i>
                    <h5><b>Ticket:</b>
                        @if ($ticket->ticket_title  == '')'Please help me with this problem'
                        @else {{ str_replace("\\","",$ticket->ticket_title) }} @endif
                    </h5>
                    <div class="widget-buttons">
                        @if ($ticket->ticket_status == '1' )
                            <span class="label label-success">Active</span>
                        @else <span class="label label-warning">Solved</span> @endif
                        @if ($ticket->ticket_priority == '1')
                            <span class="label label-important">High Priority</span>
                        @elseif ($ticket->ticket_priority == '2')
                            <span class="label label-success">Medium Priority</span>
                        @else <span class="label label-info">Low Priority</span>
                        @endif
                        <div class="btn-group" style="margin-top: -23px;">
                            <a class="btn dropdown-toggle btn-warning" data-toggle="dropdown" href="#"
                               style="color: #FFF;">Action <span class="caret"></span></a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{ url( '/admin/support/ticket/close', [ 'id' => $ticket->ticket_id ]) }}">
                                        <i class="icon-legal"></i>Close Ticket</a>
                                </li>
                                <li>
                                    <a href="{{ url( '/admin/support/ticket/unread', [ 'id' => $ticket->ticket_id ]) }}">
                                        <i class="icon-folder-close-alt"></i> Mark as Unread</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if ( isset($ticket->rating) )
                        <?php $avgTicketStar = $ticket->rating->sum('ticket_rating_value') / $ticket->rating->count('ticket_rating_id') ?>
                        <div class="widget-buttons" style="margin-right: 10px;">
                            <span style="margin: 2px 10px 0 0; display: block; float: left; font-weight: bold;">Average Ticket Rating:</span>
                            @if ( round($avgTicketStar) == 1 ) <img src="/include/img/1-star.gif" title="Bad"/> @endif
                            @if ( round($avgTicketStar) == 2 ) <img src="/include/img/2-star.gif" title="Good"/> @endif
                            @if ( round($avgTicketStar) == 3 ) <img src="/include/img/3-star.gif" title="Very good"/> @endif
                            @if ( round($avgTicketStar) == 4 ) <img src="/include/img/4-star.gif" title="Superior"/> @endif
                            @if ( round($avgTicketStar) == 5 ) <img src="/include/img/5-star.gif" title="Exceptional"/> @endif
                        </div>
                    @endif
                </div>
                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="header span12">
                            <div class="pull-left">
                                <b>{{ $ticket->userUsername }}</b>
                            </div>
                            <div class="pull-right">
                                <time><b>{{ date('l, d/m/Y',strtotime($ticket->ticket_date)) }}</b></time>
                            </div>
                        </div>
                        <p>{!! $ticket->ticket_text !!}</p>
                        <hr>
                    </div>
                    @foreach( $ticket->replies as $replay)
                        <div class="row-fluid">
                            <div class="header span12">
                                <div class="pull-left">
                                    <b>
                                        @if ($replay->adminUsername == ''){{ $replay->userUsername }}
                                        @else {{ $replay->adminUsername }} <span class="label label-success">admin</span>
                                        @endif
                                    </b>
                                </div>
                                <div class="pull-right">
                                    <time>
                                        <b>{{ date('l, d/m/Y',strtotime($replay->ticket_replay_date)) }}</b>
                                    </time>
                                </div>
                                @if ($replay->adminUsername != '' & $replay->rating != null)
                                    @if ($replay->rating->ticket_rating_value == 1) <div class="rating-done">{{ Html::image('include/img/1-star.gif', null, ['title' => 'Bad']) }}</div> @endif
                                    @if ($replay->rating->ticket_rating_value == 2) <div class="rating-done">{{ Html::image('include/img/2-star.gif', null, ['title' => 'Good']) }}</div> @endif
                                    @if ($replay->rating->ticket_rating_value == 3) <div class="rating-done">{{ Html::image('include/img/3-star.gif', null, ['title' => 'Very good']) }}</div> @endif
                                    @if ($replay->rating->ticket_rating_value == 4) <div class="rating-done">{{ Html::image('include/img/4-star.gif', null, ['title' => 'Superior']) }}</div> @endif
                                    @if ($replay->rating->ticket_rating_value == 5) <div class="rating-done">{{ Html::image('include/img/5-star.gif', null, ['title' => 'Exceptional']) }}</div> @endif
                                    <br>
                                @endif
                            </div>
                            <p>{!! $replay->ticket_reply_text !!}</p>
                            <p>{!! $replay->signature->signature_content or '' !!}</p>
                            <hr>
                        </div>
                    @endforeach


                    <div class="widget-footer">
                        <div class="row-fluid">
                            <form id="ticket" class="span12" action="{{url('/admin/support/ticket/reply')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="userUsername" value="{{ $ticket->userUsername }}"/>
                                <input type="hidden" name="adminUsername" value="{{ $user->username }}"/>
                                <input type="hidden" name="TicketID" value="{{ $ticket->ticket_id }}"/>

                                <div class="controls">
                                    <textarea name="ticketText" class="replybox span12" style="height: 250px"
                                              placeholder="Click here to reply your ticket&hellip;"></textarea>
                                </div>

                                <div class="controls">
                                    @if ($signatures->count() > 0)
                                        @foreach($signatures as $signature)
                                            <div id="signature{{ $signature['signature_id'] }}" style="margin: 0 0 15px 0; padding: 0 0 0 15px; border-left: solid 2px #CCC;">{!! $signature['signature_content']  !!}</div>
                                        @endforeach

                                        <select name="signatureID" id="signature">
                                            <option class="showSignature0" value="0">No Signature</option>
                                            @foreach($signatures as $signature)
                                                <option class="showSignature{{ $signature['signature_id'] }}" value="{{ $signature['signature_id'] }}">Signature {{ $signature['signature_id'] }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ url('/admin/signature/create') }}" class="btn btn-warning btn-mini" style="margin: 0 0 11px 15px;">Add New Signiture</a>
                                    @endif
                                </div>

                                <div class="pull-right">
                                    <button class="btn btn-primary" type="submit" name="ticketSubmit" value="Send">
                                        <i class="icon-reply"></i> Reply Ticket
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script>
        $(function() {
            $('#signature').change(function() {
                var option = $(this).find('option:selected');
                @foreach($signatures as $signature)
                $('#signature{{ $signature['signature_id'] }}').toggle(option.hasClass('showSignature{{ $signature['signature_id'] }}'));
                @endforeach
            }).change();
        });
    </script>
@stop
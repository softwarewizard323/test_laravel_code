@extends('dashboard.layouts.app')

@section('title', ' - Support')

@section('content')

    <!-- Main window -->
    <div class="main_container" id="msgRead_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span10">
                <div class="widget-header">
                    <i class="icon-ticket"></i>
                    <h5><b>Ticket:</b> @if ($ticket['ticket_title'] == '') Please help me with this problem @else {{ str_replace("\\","",$ticket['ticket_title']) }} @endif</h5>
                    <div class="widget-buttons">
                        @if ($ticket['ticket_status'] == '1') <span class="label label-success">Active</span> @else <span class="label label-warning">Closed</span>@endif
                        @if ($ticket['ticket_priority'] == '1') <span class="label label-important">High Priority</span> @elseif ($ticket['ticket_priority'] == '2') <span class="label label-success">Medium Priority</span> @else <span class="label label-info">Low Priority</span> @endif
                    </div>
                    @if ($ticket->avgRating && $ticket->avgRating->count_rating > 0)
                    <div class="widget-buttons" style="margin-right: 10px;">
                        <span style="margin: 2px 10px 0 0; display: block; float: left; font-weight: bold;">Average Ticket Rating:</span>
                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 1 ) {{ Html::image('include/img/1-star-large.gif', null, ['title' => 'Bad']) }} @endif
                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 2 ) {{ Html::image('include/img/2-star-large.gif', null, ['title' => 'Good']) }} @endif
                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 3 ) {{ Html::image('include/img/3-star-large.gif', null, ['title' => 'Very good']) }} @endif
                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 4 ) {{ Html::image('include/img/4-star-large.gif', null, ['title' => 'Superior']) }} @endif
                        @if ( round($ticket->avgRating->sum_value / $ticket->avgRating->count_rating) == 5 ) {{ Html::image('include/img/5-star-large.gif', null, ['title' => 'Exceptional']) }} @endif
                    </div>
                    @endif
                </div>
                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="header span12">
                            <div class="pull-left">
                                <b>{{ $ticket['userUsername'] }}</b>
                            </div>
                            <div class="pull-right">
                                <time><b>{{ date('l, d/m/Y',strtotime($ticket['ticket_date'])) }}</b></time>
                            </div>
                        </div>
                        <p>{!! str_replace("\\","",$ticket['ticket_text'])  !!}</p>
                        <hr>
                    </div>

                    @if ($ticket->replies->count() > 0)
                    @foreach($ticket->replies as $replay)
                    <div class="row-fluid">
                        <div class="header span12">
                            <div class="pull-left">
                                <b>
                                    @if ($replay['adminUsername'] == '') {{ $replay['userUsername'] }}
                                    @elseif ($replay['adminUsername'] == 'piyushk61') piyush <span class="label label-success">admin</span>
                                    @else {{ $replay['adminUsername'] }} <span class="label label-success">admin</span>
                                    @endif
                                </b>
                            </div>
                            <div class="pull-right">
                                <time><b>{{ date('l, d/m/Y',strtotime($replay['ticket_replay_date'])) }}</b></time>
                            </div>
                            @if ($replay->adminUsername != '' & $replay->rating != null)
                                @if ($replay->rating->ticket_rating_value == 1) <div class="rating-done">{{ Html::image('include/img/1-star.gif', null, ['title' => 'Bad']) }}</div> @endif
                                @if ($replay->rating->ticket_rating_value == 2) <div class="rating-done">{{ Html::image('include/img/2-star.gif', null, ['title' => 'Good']) }}</div> @endif
                                @if ($replay->rating->ticket_rating_value == 3) <div class="rating-done">{{ Html::image('include/img/3-star.gif', null, ['title' => 'Very good']) }}</div> @endif
                                @if ($replay->rating->ticket_rating_value == 4) <div class="rating-done">{{ Html::image('include/img/4-star.gif', null, ['title' => 'Superior']) }}</div> @endif
                                @if ($replay->rating->ticket_rating_value == 5) <div class="rating-done">{{ Html::image('include/img/5-star.gif', null, ['title' => 'Exceptional']) }}</div> @endif
                                <br>
                            @endif
                            @if ($replay->adminUsername != '' & !$replay->rating)
                                <form action="{{ url('/dashboard/support/star', ['id' => $ticket->ticket_id]) }}" method="post" class="rating">
                                    {{ csrf_field() }}
                                    <i>Please Rate Answer:</i>
                                    <input type="hidden" name="ticketRID" value="<?php echo $replay['ticket_rid']; ?>" />
                                    <input type="hidden" id="star1<?php echo $replay['ticket_rid']; ?>" name="star1" value="1" />
                                    <input type="hidden" id="star2<?php echo $replay['ticket_rid']; ?>" name="star2" value="2" />
                                    <input type="hidden" id="star3<?php echo $replay['ticket_rid']; ?>" name="star3" value="3" />
                                    <input type="hidden" id="star4<?php echo $replay['ticket_rid']; ?>" name="star4" value="4" />
                                    <input type="hidden" id="star5<?php echo $replay['ticket_rid']; ?>" name="star5" value="5" />
                                    <label for="star5" onClick="document.getElementById('star5<?php echo $replay['ticket_rid']; ?>').value = this.value; this.form.submit();" title="Exceptional" ></label>
                                    <label for="star4" onClick="document.getElementById('star4<?php echo $replay['ticket_rid']; ?>').value = this.value; this.form.submit();" title="Superior" ></label>
                                    <label for="star3" onClick="document.getElementById('star3<?php echo $replay['ticket_rid']; ?>').value = this.value; this.form.submit();" title="Very good" ></label>
                                    <label for="star2" onClick="document.getElementById('star2<?php echo $replay['ticket_rid']; ?>').value = this.value; this.form.submit();" title="Good" ></label>
                                    <label for="star1" onClick="document.getElementById('star1<?php echo $replay['ticket_rid']; ?>').value = this.value; this.form.submit();" title="Bad" ></label>
                                </form><br>
                            @endif
                        </div>
                        <p>{!! str_replace("\\","",$replay['ticket_reply_text']) !!}</p>
                        <p>@if ($replay->signature){!! $replay->signature['signature_content'] !!}@endif</p>
                        <hr>
                    </div>
                    @endforeach
                    @endif

                    <div class="widget-footer">
                        <div class="row-fluid">
                            <form class="span12" action="{{ url('/dashboard/support/answer', ['id' => $ticket->ticket_id]) }}" method="post" id="ticketSubmit">
                                {{ csrf_field() }}
                                <div class="controls">
                                    <textarea name="ticketText" class="replybox span12" style="height: 250px" placeholder="Click here to reply your ticket&hellip;"></textarea>
                                </div>

                                <div class="pull-right">
                                    <button class="btn btn-primary" type="submit" name="ticketSubmit" value="Send" > <i class="icon-reply"></i> Reply Ticket</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

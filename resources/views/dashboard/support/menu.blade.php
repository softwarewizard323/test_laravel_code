<div class="col-md-3 col-lg-2">
    <a class="btn btn-danger btn-block" id="compose-btn" @if($check_tickets) href="#" data-toggle="tooltip" data-placement="top" data-original-title="Creation new support tickets are disabled at the moment." disabled @else href="{{ url('/dashboard/support/new') }}" @endif ><i class="fa fa-plus-circle"></i> New Ticket</a>
    <ul class="nav nav-pills nav-stacked nav-email-folders mt" id="folders-list">
        <h5 class="mt">TRAFFICS</h5>
        <li @if (Request::is('dashboard/support') || Request::is('dashboard/support/all/view/'.$sid)) class="active" @endif>
            <a href="{{ url('/dashboard/support') }}">All</a>
        </li>
        @foreach($traffics as $data)
            <li @if (Request::is('dashboard/support/'.$data->id) || Request::is('dashboard/support/'.$data->id.'/view/'.$sid)) class="active" @endif>
                <a href="{{ url('/dashboard/support', ['tid' => $data->id]) }}">
                    @if($data->countUserTicketStatus > 0)
                        <span class="badge pull-right">{{ $data->countUserTicketStatus }}</span>
                    @endif
                    {{ $data->traffic_name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

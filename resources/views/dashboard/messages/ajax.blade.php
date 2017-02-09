@if(!$messages)
    <div style="text-align: center; color: #CCC; margin: 20px 0; ">No Messages</div>
@else

    @foreach($messages as $message)
        @if($message->messageStatus == 0)
            <a class="list-group-item bg-warning-light" href="{{ url('/dashboard/message', ['id' => $message->messageID]) }}">
            <span class="thumb-sm pull-left mr">
                {{ Html::image('include/style/img/people/ev-admin-avatar.gif', 'Admin') }}
            </span>
                <time class="text-link help pull-right">@if (date('d-m-Y', strtotime($message->statusUpdated)) == $currentDate) Today @else {{ date('d-m-Y', strtotime($message->statusUpdated)) }} @endif</time>
                <h5 class="no-margin fw-bold mb-xs">Admin</h5>
                <p class="deemphasize text-ellipsis no-margin">{{ $message->messageTitle }}</p>
            </a>
        @endif
    @endforeach

    @foreach($messages as $message)
        @if($message->messageStatus == 1)
            <a class="list-group-item" href="{{ url('/dashboard/message', ['id' => $message->messageID]) }}">
                <span class="thumb-sm pull-left mr">
                    {{ Html::image('include/style/img/people/ev-admin-avatar.gif', 'Admin') }}
                </span>
                <time class="text-link help pull-right">@if (date('d-m-Y', strtotime($message->statusUpdated)) == $currentDate) Today @else {{ date('d-m-Y', strtotime($message->statusUpdated)) }} @endif</time>
                <h5 class="no-margin mb-xs">Admin</h5>
                <p class="deemphasize text-ellipsis no-margin">{{ $message->messageTitle }}</p>
            </a>
        @endif
    @endforeach

@endif

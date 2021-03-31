<script type="text/javascript">
jQuery(document).ready(function($)
{
    console.log("sessione");
    console.log('{!! json_encode(session('UiKitNotifications', [])) !!}');
    console.log('{!! json_encode(Session::has('UiKitNotifications')) !!}');


    @foreach(Session::pull('UiKitNotifications') as $type => $messages)
        @foreach($messages as $message)
        add{{ ucfirst($type) }}Notification('{{ $message }}', {{ $loop->index + 1 }});
        @endforeach
    @endforeach
});

window.addUiKitNotification = function(status, message, delay)
{
    UIkit.notification({
        message: message,
        status: status,
        pos: 'top-right',
        timeout: 5000 * delay
    });    
}

window.addSuccessNotification = function(message, delay = 1)
{
    addUiKitNotification('success', message, delay);
}

window.addDangerNotification = function(message, delay = 1)
{
    addUiKitNotification('danger', message, delay * 2);
}

window.addWarningNotification = function(message, delay = 1)
{
    addUiKitNotification('warning', message, delay);
}

window.addPrimaryNotification = function(message, delay = 1)
{
    addUiKitNotification('primary', message, delay);
}
</script>
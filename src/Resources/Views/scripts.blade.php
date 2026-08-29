<script type="text/javascript">
jQuery(document).ready(function($)
{
    @foreach(Session::pull('UiKitNotifications') ?? [] as $type => $messages)
        @foreach($messages as $notification)
        @php
            $message = is_array($notification) ? ($notification['message'] ?? null) : $notification;
            $position = is_array($notification) ? ($notification['position'] ?? 'top-right') : 'top-right';
            $timeout = is_array($notification)
                ? ($notification['timeout'] ?? config('ukn.' . $type . '.timeout_ms'))
                : config('ukn.' . $type . '.timeout_ms');
            $delay = $loop->index + 1;

            if ($type === 'danger') {
                $delay *= 2;
            }
        @endphp
        addUiKitNotification(@json($type), @json($message), {{ $delay }}, @json($timeout), @json($position));
        @endforeach
    @endforeach
});

window.addUiKitNotification = function(status, message, delay = 1, timeout = 5000, position = 'top-right')
{
    UIkit.notification({
        message: message,
        status: status,
        pos: position,
        timeout: timeout * delay
    });    
}

window.addSuccessNotification = function(message, delay = 1, timeout = {{ config('ukn.success.timeout_ms', 2500) }}, position = 'top-right')
{
    addUiKitNotification('success', message, delay, timeout, position);
}

window.addDangerNotification = function(message, delay = 1, timeout = {{ config('ukn.danger.timeout_ms', 25000) }}, position = 'top-right')
{
    addUiKitNotification('danger', message, delay * 2, timeout, position);
}

window.addWarningNotification = function(message, delay = 1, timeout = {{ config('ukn.warning.timeout_ms', 7500) }}, position = 'top-right')
{
    addUiKitNotification('warning', message, delay, timeout, position);
}

window.addPrimaryNotification = function(message, delay = 1, timeout = null, position = 'top-right')
{
    addUiKitNotification('primary', message, delay, timeout, position);
}
</script>

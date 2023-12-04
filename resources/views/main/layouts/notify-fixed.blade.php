<div class="notifier-overlay"></div>
<div class="notifier-fixed">
@if (session()->has('notifications'))
    @foreach (session()->get('notifications') as $notification)
        <div class="notification -warning">
            <h3 class="notification-header">{{$notification['title']}}</h3>
            <p class="notification-header">
                {{$notification['content']}}
            </p>
        </div>
    @endforeach
@endif
</div>


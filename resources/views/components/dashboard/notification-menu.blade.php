<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{$newCount}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @if($notifications)
            <span class="dropdown-header">{{$newCount}} Notifications</span>
        @endif

        <div class="dropdown-divider"></div>
        @foreach($notifications as $notification)
            <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}" class="dropdown-item @if($notification->unread())text-bold @endif">
                <i class="{{$notification->data['icon']}}"></i> {{$notification->data['body']}}
                <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
            </a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>

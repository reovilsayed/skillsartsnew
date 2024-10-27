<div class="account-menu mb-2">
    <ul class="nav nav-tabs">
        <li><a href="{{route('dashboard')}}" class="nav-link">{{ __('sentence.my_data') }}</a></li>
        <li><a href="{{route('orders')}}" class="nav-link">{{ __('sentence.my_requests') }}</a></li>
        <li><a href="{{ route('logout') }}" class="nav-link"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('sentence.sign_out') }}</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>

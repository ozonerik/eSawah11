<li class="nav-item">
    <a href="{{ route($routename) }}" wire:navigate class="nav-link @if( request()->routeIs( $routename ) ) active @endif">
    <i class="nav-icon {{ $icon }}"></i>
        <p>{{ $name }}</p>
    </a>
</li>
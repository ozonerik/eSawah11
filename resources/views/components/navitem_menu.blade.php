<li class="nav-item">
    <a href="{{ route($routename) }}" class="nav-link @if($active) active @endif">
    <i class="nav-icon {{ $icon }}"></i>
        <p>{{ $name }}</p>
    </a>
</li>
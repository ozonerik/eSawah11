<li class="nav-item @if($open) menu-open @endif ">
    <a href="#" class="nav-link @if($open) active @endif">
        <i class="nav-icon {{ $icon }}"></i>
        <p>{{ $name }}<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        {{ $slot }}
    </ul>
</li>